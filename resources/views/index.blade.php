@php
    /* @var \BenBjurstrom\Prezet\Data\DocumentData $article */
@endphp

<x-prezet::template>
    <div class="mt-9 sm:px-8">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <div class="max-w-2xl">
                        <h1
                            class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl"
                        >
                            Laravel Developer and Tech Enthusiast
                        </h1>
                        <p class="mt-6 text-base text-zinc-600">
                            Hi I’m Ben Bjurstrom, a Laravel developer and father
                            of four based Southern California. I’m the creator
                            of MealPractice. I’m currently working on Prezet, a
                            markdown based content management system for
                            Laravel.
                        </p>
                        <x-socials />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-16 sm:mt-20">
        <x-image-banner />
    </div>
    <div class="mt-24 sm:px-8 md:mt-28">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <div
                        class="mx-auto grid max-w-xl grid-cols-1 gap-y-20 lg:max-w-none lg:grid-cols-2"
                    >
                        <div class="flex flex-col gap-16">
                            @foreach ($articles as $article)
                                <x-article :article="$article" />
                            @endforeach
                        </div>
                        <div class="space-y-10 lg:pl-16 xl:pl-24">
                            {{-- <x-newsletter /> --}}
                            <x-projects />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-prezet::template>
