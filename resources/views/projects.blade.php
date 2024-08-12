@php
    $projects = [
        [
            'title' => 'MealPractice',
            'description' => 'AI Powered Meal Planning',
            'technologies' => 'Laravel, Livewire, Alpine.js, Tailwind CSS',
            'logo' => 'https://mealpractice.com/favicon.svg',
            'href' => 'https://mealpractice.com',
        ],
        [
            'title' => 'Prezet',
            'description' => 'Markdown Blogging for Laravel',
            'technologies' => 'Laravel, Alpine.js, Tailwind CSS',
            'logo' => 'https://prezet.com/favicon.svg',
            'href' => 'https://prezet.com',
        ],
        [
            'title' => 'WebConcepts Youtube Channel',
            'description' => 'Videos covering various concepts related to web development',
            'technologies' => '109k Subscribers',
            'logo' => 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/web-concepts.png',
            'href' => 'https://www.youtube.com/c/webconcepts',
        ],
        [
            'title' => 'Personal Youtube Channel',
            'description' => 'Videos about cameras, tech, and whatever else catches my interest',
            'technologies' => '4.8k Subscribers',
            'logo' => '/favicon/favicon.svg',
            'href' => 'https://www.youtube.com/c/benbjurstrom',
        ],
    ];
@endphp

<x-prezet::template>
    @seo([
        'title' => 'My Projects',
        'description' => 'I love using technology to create new things which naturally leads me to work on a diverse range of projects.',
    ])
    <div class="mt-16 sm:mt-32 sm:px-8">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <header class="max-w-2xl">
                        <h1
                            class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl"
                        >
                            My Projects
                            {{-- Bringing Ideas to Life Through Code and Content --}}
                        </h1>
                        <p class="mt-6 text-base text-zinc-600">
                            I love using technology to create new things which
                            naturally leads me to work on a diverse range of
                            projects. From building full blown web applications
                            to contributing to the open-source community and
                            sharing knowledge through video content, here's a
                            showcase of what I've been working on lately:
                        </p>
                    </header>
                    <div class="mt-16 sm:mt-20">
                        <ul
                            role="list"
                            class="grid grid-cols-1 gap-x-12 gap-y-16 sm:grid-cols-2 lg:grid-cols-3"
                        >
                            @foreach ($projects as $project)
                                <li
                                    class="group relative flex flex-col items-start"
                                >
                                    <div
                                        class="relative z-10 flex h-12 w-12 items-center justify-center rounded-full bg-white shadow-md shadow-zinc-800/5 ring-1 ring-zinc-900/5"
                                    >
                                        <img
                                            alt=""
                                            loading="lazy"
                                            width="32"
                                            height="32"
                                            decoding="async"
                                            data-nimg="1"
                                            class="h-8 w-8"
                                            src="{{ $project['logo'] }}"
                                            style="color: transparent"
                                        />
                                    </div>
                                    <h2
                                        class="mt-6 text-base font-semibold text-zinc-800"
                                    >
                                        <div
                                            class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:rounded-2xl"
                                        ></div>
                                        <a href="{{ $project['href'] }}">
                                            <span
                                                class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"
                                            ></span>
                                            <span class="relative z-10">
                                                {{ $project['title'] }}
                                            </span>
                                        </a>
                                    </h2>
                                    <p
                                        class="relative z-10 mt-2 text-sm text-zinc-600"
                                    >
                                        {{ $project['description'] }}
                                    </p>
                                    <p
                                        class="relative z-10 text-xs text-zinc-500"
                                    >
                                        {{ $project['technologies'] }}
                                    </p>
                                    <p
                                        class="relative z-10 mt-6 flex text-xs font-medium text-zinc-400 transition group-hover:text-orange-500"
                                    >
                                        <svg
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                            class="h-6 w-6 flex-none"
                                        >
                                            <path
                                                d="M15.712 11.823a.75.75 0 1 0 1.06 1.06l-1.06-1.06Zm-4.95 1.768a.75.75 0 0 0 1.06-1.06l-1.06 1.06Zm-2.475-1.414a.75.75 0 1 0-1.06-1.06l1.06 1.06Zm4.95-1.768a.75.75 0 1 0-1.06 1.06l1.06-1.06Zm3.359.53-.884.884 1.06 1.06.885-.883-1.061-1.06Zm-4.95-2.12 1.414-1.415L12 6.344l-1.415 1.413 1.061 1.061Zm0 3.535a2.5 2.5 0 0 1 0-3.536l-1.06-1.06a4 4 0 0 0 0 5.656l1.06-1.06Zm4.95-4.95a2.5 2.5 0 0 1 0 3.535L17.656 12a4 4 0 0 0 0-5.657l-1.06 1.06Zm1.06-1.06a4 4 0 0 0-5.656 0l1.06 1.06a2.5 2.5 0 0 1 3.536 0l1.06-1.06Zm-7.07 7.07.176.177 1.06-1.06-.176-.177-1.06 1.06Zm-3.183-.353.884-.884-1.06-1.06-.884.883 1.06 1.06Zm4.95 2.121-1.414 1.414 1.06 1.06 1.415-1.413-1.06-1.061Zm0-3.536a2.5 2.5 0 0 1 0 3.536l1.06 1.06a4 4 0 0 0 0-5.656l-1.06 1.06Zm-4.95 4.95a2.5 2.5 0 0 1 0-3.535L6.344 12a4 4 0 0 0 0 5.656l1.06-1.06Zm-1.06 1.06a4 4 0 0 0 5.657 0l-1.061-1.06a2.5 2.5 0 0 1-3.535 0l-1.061 1.06Zm7.07-7.07-.176-.177-1.06 1.06.176.178 1.06-1.061Z"
                                                fill="currentColor"
                                            ></path>
                                        </svg>
                                        <a
                                            class="ml-2"
                                            href="{{ $project['href'] }}"
                                        >
                                            {{ $project['href'] }}
                                        </a>
                                    </p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-prezet::template>
