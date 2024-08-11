<header
    class="pointer-events-none relative z-50 flex flex-none flex-col"
    style="height: var(--header-height); margin-bottom: var(--header-mb)"
>
    <div class="order-last mt-[calc(theme(spacing.16)-theme(spacing.3))]"></div>
    <div
        class="top-0 order-last -mb-3 pt-3 sm:px-8"
        style="position: var(--header-position)"
    >
        <div class="mx-auto w-full max-w-7xl lg:px-8">
            <div class="relative px-4 sm:px-8 lg:px-12">
                <div class="mx-auto max-w-2xl lg:max-w-5xl">
                    <div
                        class="top-[var(--avatar-top,theme(spacing.3))] w-full"
                        style="position: var(--header-inner-position)"
                    >
                        <div class="relative">
                            <div
                                class="absolute left-0 top-3 h-10 w-10 origin-left rounded-full bg-white/90 p-0.5 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur transition-opacity"
                                style="
                                    opacity: var(--avatar-border-opacity, 0);
                                    transform: var(--avatar-border-transform);
                                "
                            ></div>
                            <a
                                aria-label="Home"
                                class="pointer-events-auto block h-16 w-16 origin-left"
                                style="transform: var(--avatar-image-transform)"
                                href="/"
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
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top-0 z-10 h-16 pt-6" style="position: var(--header-position)">
        <div
            class="top-[var(--header-top,theme(spacing.6))] w-full sm:px-8"
            style="position: var(--header-inner-position)"
        >
            <div class="mx-auto w-full max-w-7xl lg:px-8">
                <div class="relative px-4 sm:px-8 lg:px-12">
                    <div class="mx-auto max-w-2xl lg:max-w-5xl">
                        <div class="relative flex gap-4">
                            <div class="flex flex-1 justify-center">
                                <div
                                    style="
                                        position: fixed;
                                        top: 1px;
                                        left: 1px;
                                        width: 1px;
                                        height: 0;
                                        padding: 0;
                                        margin: -1px;
                                        overflow: hidden;
                                        clip: rect(0, 0, 0, 0);
                                        white-space: nowrap;
                                        border-width: 0;
                                        display: none;
                                    "
                                ></div>
                                <nav class="pointer-events-auto">
                                    <ul
                                        class="flex rounded-full bg-white/90 px-3 text-sm font-medium text-zinc-800 shadow-lg shadow-zinc-800/5 ring-1 ring-zinc-900/5 backdrop-blur"
                                    >
                                        <li>
                                            <a
                                                class="relative block px-3 py-2 transition hover:text-orange-500"
                                                href="/about"
                                            >
                                                About
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="relative block px-3 py-2 transition hover:text-orange-500"
                                                href="/articles"
                                            >
                                                Articles
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="relative block px-3 py-2 transition hover:text-orange-500"
                                                href="/projects"
                                            >
                                                Projects
                                            </a>
                                        </li>
                                        <li>
                                            <a
                                                class="relative block px-3 py-2 transition hover:text-orange-500"
                                                href="/uses"
                                            >
                                                Uses
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
