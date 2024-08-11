---
title: 'Prezet: A Markdown Content Management Package for Laravel'
date: 2024-08-09
excerpt: "Markdown-driven content management offers a compelling alternative to traditional database-driven CMS platforms and I wanted to bring that same power and elegance to the Laravel ecosystem."
---

Recently I created a package for Laravel called [Prezet](https://prezet.com/) that aims to bring the power of Markdown-driven content management to the Laravel ecosystem. In this post I'll share why I built it, the problems it solves, and how it can make your content management life easier.

## The Problem with Traditional CMS Platforms

Traditional content management systems that store content in a centralized database often present several challenges. First, by their nature the source of truth for the current state of the content resides in the production database.

This means anytime you want to modify your content, you either have to use the built-in web based editor or copy back and forth from your preferred editor to the CMS, which can be cumbersome and error-prone.

Second, tracking changes in database-stored content can be difficult, making it challenging to identify specific modifications over time.

## Markdown Files: The Simple Solution

By contrast content management systems that store content in markdown files offer several advantages:

1. **Git-Powered Version Control:** Changes are tracked efficiently. Historical modifications can be easily reviewed by looking at the git commit history.

2. **Editor Flexibility:** Any preferred Markdown editor can be used, providing a comfortable writing environment.

3. **Streamlined Collaboration:** Team collaboration is simplified through Git-based workflows.

## But why a Laravel-Specific Solution?

Ok so Markdown is great, but non Laravel ecosystems have already embraced Markdown-driven content management with great frameworks like Hugo, Gatsby, Astro, and of course the OG Jekyll.

There's also excellent tooling around Markdown in the Javascript ecosystem such as MDX which converts inline markdown to JSX components and contentlayer which generates TypeScript types from markdown files.

Even within the Laravel community we have Jigsaw as a great static site generator that leverages Laravel Blade's templating engine. So why build Prezet?

I would argue that doing everything in the same Laravel codebase as your app has the following benefits:

1. **Unified Deployment:** Content and Laravel applications coexist in a single codebase with a unified deployment process.

2. **Familiar Environment:** Leverages existing Laravel and Blade knowledge, eliminating the need to learn new frameworks.

3. **Seamless Integration:** Allows easy incorporation of dynamic features within the Laravel framework. For example, need a mailing list signup in your blog? It's just another Laravel route:

    ```php
    Route::post('/subscribe', function (Request $request) {
        // Subscription logic
    });
    ```

## Prezet's Powerhouse Features

Here are a few key features that make Prezet stand out:

### 1. Type-Safe Front Matter

Prezet validates front matter to prevent errors when rendering content:

```php
class FrontmatterData extends ValidatedDTO
{
    #[Rules(['required', 'string'])]
    public string $title;

    #[Rules(['required', 'string'])]
    public string $excerpt;

    // Additional properties
}
```

### 2. Built-in Image Optimization

Prezet automatically optimizes your images for better performance:

```markdown
![My image](image.jpg)
```

Becomes:

```html
<img
    srcset="/prezet/img/image-480w.webp 480w, ... /prezet/img/image-1536w.webp 1536w"
    sizes="92vw, (max-width: 1024px) 92vw, 768px"
    src="/prezet/img/image.webp"
    alt="My image"
/>
```

### 3. SEO Optimization

SEO meta tags are automatically generated from front matter, streamlining content optimization.

### 4. Blade Component Integration

Seamlessly integrate Laravel Blade components into your Markdown content:

```markdown
+parse
<x-prezet::youtube id="dQw4w9WgXcQ" />
```

## Ready to Simplify Your Content Management?

Prezet brings the simplicity of Markdown to the power of Laravel. It's a developer-friendly solution designed to streamline your content management workflow.

For more information and to get started with Prezet, refer to the official documentation located at [prezet.com).
](https://prezet.com).
