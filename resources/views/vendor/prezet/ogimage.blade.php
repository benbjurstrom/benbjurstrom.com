@php
    /* @var \BenBjurstrom\Prezet\Data\FrontmatterData $fm */
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <meta name="robots" content="noindex" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
    </head>
    <body
        class="font-sans text-gray-900 antialiased"
        style="height: 630px; width: 1200px"
    >
        <div class="">
            <div class="p-24">
                <h1 class="font-cal xs:min-h-1 min-h-48 text-balance text-6xl/[0.9] font-medium text-gray-950 md:text-8xl">
                    {{ $fm->title }}
                </h1>

                <div
                    class="pt-24 flex items-center space-x-4"
                >
                    <img
                        alt=""
                        fetchpriority="high"
                        width="512"
                        height="512"
                        decoding="async"
                        data-nimg="1"
                        class="h-16 w-16 rounded-full bg-zinc-100 object-cover"
                        style="color: transparent"
                        sizes="4rem"
                        srcset="
                                        /prezet/img/benbjurstrom-480w.webp   480w,
                                        /prezet/img/benbjurstrom-640w.webp   640w,
                                        /prezet/img/benbjurstrom-960w.webp   960w,
                                        /prezet/img/benbjurstrom-1536w.webp 1536w
                                    "
                        src="/prezet/img/benbjurstrom.webp"
                    />

                    <h2 class="font-cal text-4xl/[0.9] text-gray-800">
                        Ben Bjurstrom
                    </h2>
                </div>
            </div>
        </div>
    </body>
</html>
