---
title: Custom PHP Binaries with sqlite-vec SQLite Extension
date: 2025-06-25
excerpt: How to compile the sqlite-vec SQLite extension directly into your PHP binary using static-php-cli for vector similarity search capabilities.
author: benbjurstrom
image: /prezet/img/ogimages/sqlite-vec-php.webp
---

I recently needed to add vector similarity search capabilities to a PHP application using SQLite. The [sqlite-vec](https://github.com/asg017/sqlite-vec) extension provides exactly this functionality, allowing you to store and query vector embeddings directly in SQLite. However, getting it to work with PHP turned out to be more complex than expected.

## The Challenge with SQLite Extensions in PHP

When you use SQLite from PHP, you're not actually using a system-installed SQLite binary. Instead, the SQLite library is compiled directly into the PHP binary itself. This means that if you want to use a SQLite extension like sqlite-vec, you can't simply install it system-wide and expect it to work.

Instead you have two options:

1. Load the extension dynamically using PDO's `loadExtension()` method
2. Compile the extension directly into your PHP binary

Unfortunately, many PHP distributions have `loadExtension()` disabled for security reasons. You can check if your PHP binary supports loading extensions by running the following command:

```bash
php -d detect_unicode=0 -r '
  $pdo = new PDO("sqlite::memory:");
  var_dump(method_exists($pdo, "loadExtension"));
'
```

If this returns `true`, you're in luck! You can simply grab a precompiled sqlite-vec build from the [releases](https://github.com/asg017/sqlite-vec/releases) page and load it like this:

```php
$pdo = new PDO("sqlite::memory:");
$pdo->loadExtension('/path/to/vec0.dylib');
```

But if you don't have loadExtension enabled (as is the case in many production PHP builds), you'll need to compile your own custom php binary.

## What is sqlite-vec?

Before diving into the compilation process, let's understand why you might want to add this extension in the first place. Sqlite-vec is a SQLite extension that brings vector similarity search capabilities to SQLite databases. It allows you to:

- Store vector embeddings as a native SQLite data type
- Perform fast similarity searches using various distance metrics
- Build applications with semantic search, recommendation systems, and RAG (Retrieval-Augmented Generation) capabilities

This is particularly useful if you're working with AI models, embeddings from OpenAI, or building search features that go beyond simple keyword matching.

## Compiling sqlite-vec into PHP

Since we can't load the extension dynamically, we'll compile it directly into the PHP binary. For this task, I'm using [static-php-cli](https://static-php.dev/en/guide/), a powerful tool for building custom PHP binaries with specific extensions and configurations.

The process involves:
1. Setting up the build environment
2. Downloading the sqlite-vec source code
3. Creating a patch script to integrate sqlite-vec into PHP's SQLite3 extension
4. Building the custom PHP binary

Here's the complete build process for macOS on Apple Silicon. The general approach works on Linux and Windows too, though some specific commands will differ.

### 1. Set Up Your Environment

First, install the necessary build tools:

```bash
xcode-select --install
brew install automake autoconf libtool cmake pkg-config gzip wget coreutils
```

Create a workspace and download static-php-cli:

```bash
mkdir -p ~/sqlite-vec-php/{php-bin,static-php-cli}
cd ~/sqlite-vec-php/static-php-cli
curl -fsSL -o spc.tgz \
  https://github.com/crazywhalecc/static-php-cli/releases/download/2.6.0/spc-macos-aarch64.tar.gz
tar -xzf spc.tgz && rm spc.tgz
chmod +x spc
```

### 2. Create the Patch Script

The key to this process is a patch script that tells static-php-cli how to integrate sqlite-vec into the PHP build. Create a file called `patch_sqlitevec.php` within the static-php-cli directory:

```php
<?php
// patch_sqlitevec.php – works with static-php-cli ≥ 2.0
use SPC\store\FileSystem as FS;

$vecDir = __DIR__ . '/sqlite-vec';           // where sqlite-vec.c/h live
$phpDir = SOURCE_PATH . '/php-src';          // root of extracted php-src
$sqliteExtDir = $phpDir . '/ext/sqlite3';
$sqliteDir = $phpDir . '/sqlite3';

// 1 Create core_init.c manually
if (patch_point() === 'after-php-extract') {
    $coreInit = <<<C
#define SQLITE_CORE 1
#include "sqlite3.h"
#include "sqlite-vec.h"
#include <stdio.h>

int core_init(const char *dummy) {
    return sqlite3_auto_extension((void *)sqlite3_vec_init);
}
C;

    file_put_contents($sqliteExtDir . '/core_init.c', $coreInit);
    file_put_contents($sqliteExtDir . '/sqlite-vec.c', file_get_contents($vecDir . '/sqlite-vec.c'));
    file_put_contents($sqliteExtDir . '/sqlite-vec.h', file_get_contents($vecDir . '/sqlite-vec.h'));
}

// 2 Overwrite config0.m4 with working content
if (patch_point() === 'before-php-configure') {
    $cfg = $sqliteExtDir . '/config0.m4';
    $workingM4 = <<<M4
PHP_ARG_WITH([sqlite3],
  [whether to enable the SQLite3 extension],
  [AS_HELP_STRING([--without-sqlite3],
    [Do not include SQLite3 support.])],
  [yes])

if test \$PHP_SQLITE3 != "no"; then
  PHP_SETUP_SQLITE([SQLITE3_SHARED_LIBADD])
  AC_DEFINE([HAVE_SQLITE3], [1],
    [Define to 1 if the PHP extension 'sqlite3' is available.])

  PHP_CHECK_LIBRARY([sqlite3], [sqlite3_errstr],
    [AC_DEFINE([HAVE_SQLITE3_ERRSTR], [1],
      [Define to 1 if SQLite library has the 'sqlite3_errstr' function.])],
    [],
    [\$SQLITE3_SHARED_LIBADD])

  PHP_CHECK_LIBRARY([sqlite3], [sqlite3_expanded_sql],
    [AC_DEFINE([HAVE_SQLITE3_EXPANDED_SQL], [1],
      [Define to 1 if SQLite library has the 'sqlite3_expanded_sql' function.])],
    [],
    [\$SQLITE3_SHARED_LIBADD])

  PHP_CHECK_LIBRARY([sqlite3], [sqlite3_load_extension],
    [],
    [AC_DEFINE([SQLITE_OMIT_LOAD_EXTENSION], [1],
      [Define to 1 if SQLite library was compiled with the
      SQLITE_OMIT_LOAD_EXTENSION and does not have the extension support with
      the 'sqlite3_load_extension' function. For usage in the sqlite3 PHP
      extension. See https://www.sqlite.org/compile.html.])],
    [\$SQLITE3_SHARED_LIBADD])

  PHP_NEW_EXTENSION([sqlite3],
    [sqlite3.c],
    [\$ext_shared],,
    [-DZEND_ENABLE_STATIC_TSRMLS_CACHE=1])
  PHP_SUBST([SQLITE3_SHARED_LIBADD])
fi

dnl ---- sqlite-vec static compile ----
AC_MSG_NOTICE([Adding sqlite-vec.c + core_init.c to SQLite3 static library])
AC_DEFINE([SQLITE_ENABLE_VEC0], [1], [Enable sqlite-vec virtual table])
AC_DEFINE([SQLITE_CORE], [1], [Build sqlite-vec as builtin])
PHP_ADD_SOURCES(ext/sqlite3, [sqlite-vec.c core_init.c])

PHP_SQLITE3_PRIVATE_SRCS="\$PHP_SQLITE3_PRIVATE_SRCS sqlite-vec.c"
AC_DEFINE([SQLITE_VEC_ENABLE_NEON],1,[Enable NEON])
AC_DEFINE([SQLITE_VEC_STATIC],1,[Static sqlite-vec])
M4;

    file_put_contents($cfg, $workingM4);
}

// 3 hook the extension in MINIT just before make
if (patch_point() === 'before-php-make') {
    $cfile = $phpDir . '/ext/sqlite3/sqlite3.c';
    FS::replaceFileUser($cfile, function ($code) {
        if (str_contains($code, 'sqlite3_vec_init')) return $code;      // already patched
        $inject = "\n    extern int sqlite3_vec_init(sqlite3*,char**,const sqlite3_api_routines*);\n"
                . "    sqlite3_auto_extension((void(*)(void))sqlite3_vec_init);\n";
        return preg_replace('/PHP_MINIT_FUNCTION\\(sqlite3\\)\\s*\\{/', '$0' . $inject, $code, 1);
    });
}
```

### 3. Configure Extensions and Libraries

Create configuration files for the PHP extensions and libraries you want to include:

```bash
cd ~/sqlite-vec-php
cat > php-extensions.txt <<'TXT'
bcmath,bz2,ctype,curl,dom,fileinfo,filter,gd,iconv,mbstring,opcache,openssl,pdo,pdo_sqlite,phar,session,simplexml,sockets,sqlite3,tokenizer,xml,zip,zlib
TXT

cat > php-libraries.txt <<'TXT'
libjpeg,freetype,libwebp
TXT
```

### 4. Download Dependencies

Download PHP 8.4 and all required dependencies:

```bash
cd ~/sqlite-vec-php/static-php-cli
EXT=$(grep -v '^\s*#' ../php-extensions.txt | tr -d '\n ')
LIB=$(grep -v '^\s*#' ../php-libraries.txt | tr -d '\n ')
./spc download --with-php=8.4 --for-extensions "$EXT" --prefer-pre-built
```

### 5. Get sqlite-vec Source

Download the sqlite-vec amalgamation build:

```bash
curl -L -o sqlite-vec.zip \
     https://github.com/asg017/sqlite-vec/releases/download/v0.1.7-alpha.2/sqlite-vec-0.1.7-alpha.2-amalgamation.zip
unzip sqlite-vec.zip -d sqlite-vec
```

### 6. Build Your Custom PHP Binary

Now for the main event - building PHP with sqlite-vec included:

```bash
EXT=$(tr -d '\n ' < ../php-extensions.txt)
LIB=$(tr -d '\n ' < ../php-libraries.txt)

./spc build --build-cli --build-fpm "$EXT" --with-libs "$LIB" \
            -P patch_sqlitevec.php --debug
```

### 7. Test Your New Binary

Once the build completes, test that sqlite-vec is working:

```bash
buildroot/bin/php -r 'echo (new SQLite3(":memory:"))->querySingle("SELECT vec_version()"), PHP_EOL;'
```

If everything worked correctly, you should see the sqlite-vec version number printed to the console.

## Using sqlite-vec in Your PHP Application

With your custom PHP binary, you can now use sqlite-vec directly without any extension loading:

```php
$vectorDb = new PDO('sqlite::memory:');
$vectorDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create a table with vector column
$vectorDb->exec('CREATE TABLE embeddings (id INTEGER PRIMARY KEY, vec F32_BLOB(384))');

// Insert a vector
$vector = array_fill(0, 384, 0.1);
$blob = pack('f*', ...$vector);
$stmt = $vectorDb->prepare('INSERT INTO embeddings (vec) VALUES (?)');
$stmt->bindValue(1, $blob, PDO::PARAM_LOB);
$stmt->execute();

// Query similar vectors
$queryVector = array_fill(0, 384, 0.15);
$queryBlob = pack('f*', ...$queryVector);
$stmt = $vectorDb->prepare('SELECT id, vec_distance_l2(vec, ?) as distance FROM embeddings ORDER BY distance LIMIT 5');
$stmt->bindValue(1, $queryBlob, PDO::PARAM_LOB);
$stmt->execute();
dd($stmt->fetchAll(PDO::FETCH_ASSOC));  
```

## Packaging for NativePHP

If you're building this for use with [NativePHP](https://nativephp.com/), you can package it like this:

```bash
ROOT=~/sqlite-vec-php
SPC=$ROOT/static-php-cli
PKG=$ROOT/php-bin/bin/mac/arm64
mkdir -p "$PKG"
cp $SPC/buildroot/bin/php "$PKG/php"
(cd "$PKG" && zip -q php-8.4.zip php && rm php)
```

## Conclusion

The sqlite-vec extension opens up exciting possibilities for PHP applications, from semantic search to recommendation systems. By following this guide, you can bring these vector search capabilities to your PHP projects without relying on external vector databases.

For more information about sqlite-vec capabilities and usage, check out the [official documentation](https://alexgarcia.xyz/sqlite-vec/features/knn.html). And if you're interested in building custom PHP binaries for other purposes, the [static-php-cli documentation](https://static-php.dev/en/guide/) is an excellent resource.
