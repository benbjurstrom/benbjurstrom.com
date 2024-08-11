@php
    $categories = [
        [
            'id' => 'workstation',
            'name' => 'Workstation',
            'items' => [
                [
                    'name' => '14" MacBook Pro, M1 Max, 64GB RAM (2021)',
                    'description' => 'This is the best computer I\'ve ever owned. It\'s fast, has great battery life, and is super portable. I\'m not sure what else I could ask for in a laptop.',
                    'link' => 'https://www.apple.com/macbook-pro',
                ],
                [
                    'name' => 'Apple Studio Display (5K, 27")',
                    'description' => 'I use two of these as my main monitors. They\'re super sharp and the built-in webcam is great for video calls.',
                    'link' => 'https://www.apple.com/studio-display/',
                ],
                [
                    'name' => 'Keychron Wired V1 Knob',
                    'description' => 'I\'ve tried a lot of mechanical keyboards and this is the one I keep coming back to. The knob is great for controlling volume.',
                    'link' => 'https://amzn.to/3AmzGLt',
                ],
                [
                    'name' => 'Logitech MX Master 3S',
                    'description' => 'The S stands for Silent and it\'s a game changer. I can\'t believe how much quieter this is than the previous version.',
                    'link' => 'https://amzn.to/4dg1wra',
                ],
            ],
        ],
        [
            'id' => 'development-tools',
            'name' => 'Development tools',
            'items' => [
                [
                    'name' => 'PHPStorm w/ Laravel Idea',
                    'description' => 'This is my go-to IDE for PHP development. It has great support for Laravel and tons of other features that make my life easier.',
                    'link' => 'https://www.jetbrains.com/phpstorm/laravel',
                ],
                [
                    'name' => 'Tower',
                    'description' => 'I use Tower for all of my Git needs. It has a great UI and makes it easy to manage my repositories.',
                    'link' => 'https://www.git-tower.com/',
                ],
                [
                    'name' => 'TablePlus',
                    'description' => 'I\'ve tried a lot of database clients and this is the one I keep coming back to. It\'s fast, has a great UI, and supports all of the databases I use.',
                    'link' => 'https://tableplus.com/',
                ],
            ],
        ],
    ];
@endphp

<x-prezet::template>
    <div class="mt-16 sm:mt-32 sm:px-8">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <header class="max-w-2xl">
                        <h1
                            class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl"
                        >
                            The tools I use for Building, Creating, and Staying
                            Productive
                        </h1>
                        <p class="mt-6 text-base text-zinc-600">
                            I value efficiency and elegance that inspire
                            creativity. As such I put a lot of thought and care
                            into the tools I use to get things done. Here's a big
                            list of all of my favorite stuff I use on a daily
                            basis.
                        </p>
                    </header>
                    <div class="mt-16 sm:mt-20">
                        <div class="space-y-20">
                            @foreach ($categories as $category)
                                <section
                                    aria-labelledby="{{ $category['id'] }}"
                                    class="md:border-l md:border-zinc-100 md:pl-6"
                                >
                                    <div
                                        class="grid max-w-3xl grid-cols-1 items-baseline gap-y-8 md:grid-cols-4"
                                    >
                                        <h2
                                            id="{{ $category['id'] }}"
                                            class="text-sm font-semibold text-zinc-800"
                                        >
                                            {{ $category['name'] }}
                                        </h2>
                                        <div class="md:col-span-3">
                                            <ul role="list" class="space-y-16">
                                                @foreach ($category['items'] as $item)
                                                    <li
                                                        class="group relative flex flex-col items-start"
                                                    >
                                                        <h3
                                                            class="text-base font-semibold tracking-tight text-zinc-800"
                                                        >
                                                            @if ($item['link'])
                                                                <a
                                                                    href="{{ $item['link'] }}"
                                                                    target="_blank"
                                                                    rel="noopener noreferrer"
                                                                >
                                                                    {{ $item['name'] }}
                                                                </a>
                                                            @else
                                                                {{ $item['name'] }}
                                                            @endif
                                                        </h3>
                                                        <p
                                                            class="relative z-10 mt-2 text-sm text-zinc-600"
                                                        >
                                                            {{ $item['description'] }}
                                                        </p>
                                                        <a
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                            href="{{ $item['link'] }}"
                                                            class="relative z-10 mt-2 text-sm text-zinc-500"
                                                        >
                                                            {{ $item['link'] }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-prezet::template>
