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

<div class="rounded-2xl border border-zinc-100 p-6">
    <h2 class="flex text-sm font-semibold text-zinc-900">
        <svg
            viewBox="0 0 24 24"
            fill="none"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round"
            aria-hidden="true"
            class="h-6 w-6 flex-none"
        >
            <path
                d="M2.75 9.75a3 3 0 0 1 3-3h12.5a3 3 0 0 1 3 3v8.5a3 3 0 0 1-3 3H5.75a3 3 0 0 1-3-3v-8.5Z"
                class="fill-zinc-100 stroke-zinc-400"
            ></path>
            <path
                d="M3 14.25h6.249c.484 0 .952-.002 1.316.319l.777.682a.996.996 0 0 0 1.316 0l.777-.682c.364-.32.832-.319 1.316-.319H21M8.75 6.5V4.75a2 2 0 0 1 2-2h2.5a2 2 0 0 1 2 2V6.5"
                class="stroke-zinc-400"
            ></path>
        </svg>
        <span class="ml-3">My Projects</span>
    </h2>
    <ol class="mt-6 space-y-4">
        @foreach ($projects as $project)
            <li>
                <a href="{{ $project['href'] }}" class="block flex gap-4">
                    <div
                        class="relative mt-1 flex h-10 w-10 flex-none items-center justify-center rounded-full shadow-md shadow-zinc-800/5 ring-1 ring-zinc-900/5"
                    >
                        <img
                            alt=""
                            loading="lazy"
                            width="32"
                            height="32"
                            decoding="async"
                            data-nimg="1"
                            class="h-7 w-7"
                            style="color: transparent"
                            src="{{ $project['logo'] }}"
                        />
                    </div>
                    <dl class="flex flex-auto flex-wrap gap-x-2">
                        <dt class="sr-only">title</dt>
                        <dd
                            class="w-full flex-none text-sm font-medium text-zinc-900"
                        >
                            {{ $project['title'] }}
                        </dd>
                        <dt class="sr-only">description</dt>
                        <dd class="text-xs text-zinc-500">
                            {{ $project['description'] }}
                        </dd>
                        <dt class="sr-only">Technologies</dt>
                        <dd class="text-xs text-zinc-400">
                            {{ $project['technologies'] }}
                        </dd>
                    </dl>
                </a>
            </li>
        @endforeach
    </ol>
    <a
        class="group mt-6 inline-flex w-full items-center justify-center gap-2 rounded-md bg-zinc-50 px-3 py-2 text-sm font-medium text-zinc-900 outline-offset-2 transition hover:bg-zinc-100 active:bg-zinc-100 active:text-zinc-900/60 active:transition-none"
        href="#"
    >
        Download CV
        <svg
            viewBox="0 0 16 16"
            fill="none"
            aria-hidden="true"
            class="h-4 w-4 stroke-zinc-400 transition group-active:stroke-zinc-600"
        >
            <path
                d="M4.75 8.75 8 12.25m0 0 3.25-3.5M8 12.25v-8.5"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></path>
        </svg>
    </a>
</div>
