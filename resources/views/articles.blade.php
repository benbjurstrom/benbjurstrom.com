<x-prezet::template>
    <div class="mt-16 sm:mt-32 sm:px-8">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <header class="max-w-2xl">
                        <h1
                            class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl"
                        >
                            My Writing
                        </h1>
                        <p class="mt-6 text-base text-zinc-600">
                            All of my long-form thoughts on programming,
                            technology, and more. Presented in chronological
                            order.
                        </p>
                    </header>
                    <div class="mt-16 sm:mt-20">
                        <div class="md: md:border-l md:border-zinc-100 md:pl-6">
                            <div class="flex max-w-3xl flex-col space-y-16">
                                @foreach ($articles as $article)
                                    <x-article2 :article="$article" />
                                @endforeach
                            </div>

                            <div class="mt-12">
                                {{ $paginator->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-prezet::template>
