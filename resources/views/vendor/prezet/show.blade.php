<x-prezet::template>
    <x-prezet::alpine>
        @seo([
            'title' => $frontmatter->title,
            'description' => $frontmatter->excerpt,
            'url' => route('prezet.show', ['slug' => $frontmatter->slug]),
            'image' => $frontmatter->image,
        ])

        <div
            class="relative mx-auto flex w-full max-w-6xl flex-auto justify-center sm:px-2 lg:px-8 xl:px-12"
        >
            <div
                class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:pl-8 lg:pr-0 xl:max-w-none xl:px-16"
            >
                <article>
                    <header class="mb-9 space-y-1">
                        <p
                            class="font-display text-sm font-medium text-primary-600"
                        >
                            {{ $frontmatter->category }}
                        </p>
                        <h1
                            class="font-display text-4xl font-medium tracking-tight text-stone-900"
                        >
                            {{ $frontmatter->title }}
                        </h1>
                    </header>
                    <div
                        class="prose-h2:mt-12 prose-h3:mt-8 prose-headings:font-display prose-stone prose max-w-none prose-a:border-b prose-a:border-dashed prose-a:border-black/30 prose-a:font-semibold prose-a:no-underline hover:prose-a:border-solid prose-img:rounded"
                    >
                        {!! $body !!}
                    </div>
                </article>
            </div>
            {{-- Right Sidebar --}}
            <div
                class="hidden xl:sticky xl:top-[4.75rem] xl:-mr-6 xl:block xl:h-[calc(100vh-4.75rem)] xl:flex-none xl:overflow-y-auto xl:py-16 xl:pr-6"
            >
                <nav aria-labelledby="on-this-page-title" class="w-56">
                    <p
                        id="on-this-page-title"
                        class="font-display text-sm font-medium text-stone-900"
                    >
                        On this page
                    </p>
                    <ol role="list" class="mt-4 space-y-3 text-sm">
                        @foreach ($headings as $h2)
                            <li>
                                <a
                                    href="#{{ $h2['id'] }}"
                                    :class="{'text-primary-500 hover:text-primary-500': activeHeading === '#{{ $h2['title'] }}'}"
                                    x-on:click.prevent="scrollToHeading('{{ $h2['id'] }}')"
                                    class="transition-colors"
                                >
                                    {{ $h2['title'] }}
                                </a>

                                @if ($h2['children'])
                                    <ol
                                        role="list"
                                        class="mt-2 space-y-3 border-l pl-5"
                                    >
                                        @foreach ($h2['children'] as $h3)
                                            <li>
                                                <a
                                                    href="#{{ $h3['id'] }}"
                                                    :class="{'text-primary-700 hover:text-primary-700': activeHeading === '#{{ $h3['title'] }}'}"
                                                    x-on:click.prevent="scrollToHeading('{{ $h3['id'] }}')"
                                                    class="transition-colors"
                                                >
                                                    {{ $h3['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ol>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </x-prezet::alpine>
</x-prezet::template>
