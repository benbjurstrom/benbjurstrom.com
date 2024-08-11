<article class="group relative flex flex-col items-start">
    <h2 class="text-base font-semibold tracking-tight text-zinc-800">
        <div
            class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 sm:-inset-x-6 sm:rounded-2xl"
        ></div>
        <a href="{{ route('prezet.show', $article->slug) }}">
            <span
                class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"
            ></span>
            <span class="relative z-10">
                {{ $article->title }}
            </span>
        </a>
    </h2>
    <time
        class="relative z-10 order-first mb-3 flex items-center pl-3.5 text-sm text-zinc-400"
        datetime="2022-09-05"
    >
        <span
            class="absolute inset-y-0 left-0 flex items-center"
            aria-hidden="true"
        >
            <span class="h-4 w-0.5 rounded-full bg-zinc-200"></span>
        </span>
        {{ $article->createdAt->format('F j, Y') }}
    </time>
    <p class="relative z-10 mt-2 text-sm text-zinc-600">
        {{ $article->excerpt }}
    </p>
    <div
        aria-hidden="true"
        class="relative z-10 mt-4 flex items-center text-sm font-medium text-orange-500"
    >
        Read article
        <svg
            viewBox="0 0 16 16"
            fill="none"
            aria-hidden="true"
            class="ml-1 h-4 w-4 stroke-current"
        >
            <path
                d="M6.75 5.75 9.25 8l-2.5 2.25"
                stroke-width="1.5"
                stroke-linecap="round"
                stroke-linejoin="round"
            ></path>
        </svg>
    </div>
</article>
