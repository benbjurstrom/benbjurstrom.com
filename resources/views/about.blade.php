<x-prezet::template>
    @seo([
        'title' => 'About',
        'description' => 'I\'m Ben Bjurstrom a Laravel Developer and Tech Enthusiast.',
    ])
    <div class="mt-16 sm:mt-32 sm:px-8">
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <div
                        class="grid grid-cols-1 gap-y-16 lg:grid-cols-2 lg:grid-rows-[auto_1fr] lg:gap-y-12"
                    >
                        <div class="lg:pl-20">
                            <div class="max-w-xs px-2.5 lg:max-w-none">
                                <img
                                    alt=""
                                    loading="lazy"
                                    width="800"
                                    height="800"
                                    decoding="async"
                                    data-nimg="1"
                                    class="aspect-square rotate-3 rounded-2xl bg-zinc-100 object-cover"
                                    sizes="(min-width: 1024px) 32rem, 20rem"
                                    srcset="
                                        /prezet/img/benbjurstrom-480w.webp   480w,
                                        /prezet/img/benbjurstrom-640w.webp   640w,
                                        /prezet/img/benbjurstrom-960w.webp   960w,
                                        /prezet/img/benbjurstrom-1536w.webp 1536w
                                    "
                                    src="/prezet/img/benbjurstrom.webp"
                                    style="color: transparent"
                                />
                            </div>
                        </div>
                        <div class="lg:order-first lg:row-span-2">
                            <h1
                                class="text-4xl font-bold tracking-tight text-zinc-800 sm:text-5xl"
                            >
                                Hey, I'm Ben Bjurstrom a Laravel Developer and
                                Tech Enthusiast
                            </h1>
                            <div class="mt-6 space-y-7 text-base text-zinc-600">
                                <p>
                                    I'm a Laravel developer living in Southern
                                    California with my wife and our four kids.
                                    When I'm not writing code or chasing after
                                    the little ones, you'll probably find me
                                    catching up on the latest tech trends.
                                </p>
                                <p>
                                    I'm fascinated by the rapid advancements in
                                    AI and machine learning. It's mind-blowing
                                    to see how these technologies are reshaping
                                    our world, and I'm always eager to explore
                                    their potential in my work.
                                </p>
                                <p>
                                    Side projects are my outlet for creativity
                                    and learning. One of my recent creations is
                                    MealPractice, a web app that takes the
                                    hassle out of meal planning. I'm currently
                                    working on Prezet, an easy to use Laravel
                                    package that brings markdown-based content
                                    management to the framework.
                                </p>
                            </div>
                        </div>
                        <div class="lg:pl-20">
                            <ul role="list">
                                <li class="flex">
                                    <a
                                        class="group flex text-sm font-medium text-zinc-800 transition hover:text-orange-500"
                                        href="#"
                                    >
                                        <x-si-x
                                            aria-hidden="true"
                                            class="h-5 w-5 flex-none fill-zinc-500 transition group-hover:fill-orange-500"
                                        />
                                        <span class="ml-4">Follow on X</span>
                                    </a>
                                </li>
                                <li class="mt-4 flex">
                                    <a
                                        class="group flex text-sm font-medium text-zinc-800 transition hover:text-orange-500"
                                        href="#"
                                    >
                                        <x-si-threads
                                            aria-hidden="true"
                                            class="h-5 w-5 flex-none fill-zinc-500 transition group-hover:fill-orange-500"
                                        />
                                        <span class="ml-4">
                                            Follow on Threads
                                        </span>
                                    </a>
                                </li>
                                <li class="mt-4 flex">
                                    <a
                                        class="group flex text-sm font-medium text-zinc-800 transition hover:text-orange-500"
                                        href="#"
                                    >
                                        <x-si-github
                                            aria-hidden="true"
                                            class="h-5 w-5 flex-none fill-zinc-500 transition group-hover:fill-orange-500"
                                        />
                                        <span class="ml-4">
                                            Follow on GitHub
                                        </span>
                                    </a>
                                </li>
                                <li class="mt-4 flex">
                                    <a
                                        class="group flex text-sm font-medium text-zinc-800 transition hover:text-orange-500"
                                        href="#"
                                    >
                                        <x-si-linkedin
                                            aria-hidden="true"
                                            class="h-5 w-5 flex-none fill-zinc-500 transition group-hover:fill-orange-500"
                                        />
                                        <span class="ml-4">
                                            Follow on LinkedIn
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-prezet::template>
