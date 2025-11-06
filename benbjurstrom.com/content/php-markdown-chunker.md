---
title: Intelligent Document Chunking for PHP
date: "2025-11-05T08:00:00.000Z"
excerpt: A native PHP solution for intelligent Markdown chunking that preserves document structure and semantic meaning.
author: benbjurstrom
image: /prezet/img/ogimages/php-markdown-chunker.webp
---

I've been working on an idea for an open source Laravel application that lets you chat with your documents using local LLMs. However, building such an app requires a chunking strategy. Basically a process to break documents into semantic pieces that preserve meaning while fitting within an embedding model's context window.

Python developers have countless options for this, but the PHP ecosystem had nothing I could find as of the date of this post. Rather than spin up a Python service I decided to build a native PHP solution.

The result is [Markdown Object](https://github.com/benbjurstrom/markdown-object), a package that intelligently chunks Markdown while preserving document structure and semantic relationships.

## Why Chunking Matters for Vector Search

If you've worked with vector databases and embeddings, you know that your chunking strategy directly impacts search quality. Throw an entire document into a single embedding and you lose specificity. Split it into arbitrary 500-character chunks and you destroy semantic meaning.

This is the problem Markdown Object attempts to solve. It converts your Markdown into a hierarchical object representation, then generates chunks that maintain their semantic context through breadcrumbs built from document headings.

## How It Works

The package builds on top of [League CommonMark](https://github.com/thephpleague/commonmark) for parsing and [Yethee\Tiktoken](https://github.com/yethee/tiktoken-php) for accurate token counting. Here's a basic example:

```php
use League\CommonMark\Environment\Environment;
use League\CommonMark\Parser\MarkdownParser;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use BenBjurstrom\MarkdownObject\Build\MarkdownObjectBuilder;
use BenBjurstrom\MarkdownObject\Tokenizer\TikTokenizer;

// Parse your Markdown
$env = new Environment();
$env->addExtension(new CommonMarkCoreExtension());
$parser = new MarkdownParser($env);
$doc = $parser->parse($markdown);

// Build the structured model
$builder = new MarkdownObjectBuilder();
$tokenizer = TikTokenizer::forModel('gpt-3.5-turbo');
$mdObj = $builder->build($doc, 'guide.md', $markdown, $tokenizer);

// Generate semantic chunks
$chunks = $mdObj->toMarkdownChunks(target: 512, hardCap: 1024);
```

Each chunk that comes out includes not just the content, but also its location in the document hierarchy:

```php
foreach ($chunks as $chunk) {
    echo implode(' › ', $chunk->breadcrumb) . "\n";
    // Output: "guide.md › Getting Started › Installation"
    
    echo $chunk->markdown;
    // The actual Markdown content, ready for vectorization
}
```

## The Art of Finding the Right Chunk Size

After building the core functionality, I quickly realized that effective chunking isn't just about the algorithm. It's about finding the right balance for your specific content. That's why I built a [interactive demo application](https://github.com/benbjurstrom/markdown-object-demo) that lets you experiment with your own content in real-time:

![Screenshot showing the Markdown Object demo interface with a Markdown editor on the left and chunk visualization on the right](php-markdown-chunker-1762388105292.webp)

The demo app lets you paste in your Markdown, adjust the target and hard cap parameters, and immediately see how your content gets chunked. You can see exactly where each chunk starts and ends, what breadcrumbs it carries, and how many tokens it contains.

## Hierarchical Greedy Packing

Under the hood, the package uses what I call "hierarchical greedy packing" to create chunks. The algorithm respects your document's natural structure:

1. If the entire document fits within the hard cap, it returns as a single chunk
2. When too large, it splits at the highest heading level first (H1, then H2, etc.)
3. It greedily packs sibling sections that fit together within the token limit
4. Large paragraphs, code blocks, and tables intelligently break at the target boundary

This approach ensures that related content stays together when possible, while still respecting token limits for your embedding model.

## Beyond RAG: The Object Representation

While I built this primarily for vectorization workflows, the intermediate object representation may prove useful for other tasks too. The structured model gives you programmatic access to your document's hierarchy, making it easy to extract specific sections, generate table of contents, or transform content in other ways.

You can even serialize the entire structure to JSON for caching or further processing:

```php
// Serialize to JSON
$json = $mdObj->toJson(JSON_PRETTY_PRINT);

// Deserialize later
$mdObj = MarkdownObject::fromJson($json);
```

## Getting Started

If you're building a RAG application in PHP, you can install the package via Composer:
```bash
composer require benbjurstrom/markdown-object
```

The package is open source and available on [GitHub](https://github.com/benbjurstrom/markdown-object). If you run into issues or have suggestions for improvements, feel free to open an issue or submit a pull request.

For the complete Laravel RAG stack, pair this with my [pgvector driver for Laravel Scout](https://benbjurstrom.com/pgvector-for-laravel-scout). Together they provide a fully native PHP solution: Markdown Object handles the intelligent chunking, while the pgvector driver manages vector storage and similarity search with Scout's model observers keeping everything in sync automatically.
