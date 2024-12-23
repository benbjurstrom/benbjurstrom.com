<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="light h-full antialiased"
>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://cdn.jsdelivr.net" />

        <link
            rel="icon"
            href="/favicon.ico"
            type="image/x-icon"
            sizes="16x16"
        />
        <link
            rel="icon"
            href="/favicon.svg"
            type="image/svg+xml"
            sizes="any"
        />
        <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="/favicon/apple-touch-icon.png"
        />
        <link
            rel="icon"
            sizes="32x32"
            type="image/png"
            href="/favicon/favicon-32x32.png"
        />
        <link
            rel="mask-icon"
            href="/favicon/safari-pinned-tab.svg"
            color="#000000"
        />
        <link rel="shortcut icon" href="/favicon/favicon.ico" />

        <x-seo::meta />

        <!-- Scripts -->
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/@benbjurstrom/alpinejs-zoomable/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/lite-youtube-embed@0.3.2/src/lite-yt-embed.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.14.1/dist/cdn.min.js"
        ></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"
        ></script>
        @vite(['resources/css/app.css'])
    </head>

    <body class="flex h-full bg-zinc-50">
        <div class="flex w-full">
            <div class="fixed inset-0 flex justify-center lg:px-8">
                <div class="flex w-full max-w-7xl lg:px-8">
                    <div class="w-full bg-white ring-1 ring-zinc-100"></div>
                </div>
            </div>
            <div class="relative flex w-full flex-col">
                <x-header />
                <div
                    class="flex-none"
                    style="height: var(--content-offset)"
                ></div>
                <main class="flex-auto">
                    {{ $slot }}
                </main>
                <x-footer />
            </div>
        </div>
    </body>
</html>
