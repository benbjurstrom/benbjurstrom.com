<template>
    <div @mouseleave="unfocus">
        <a
            v-for="(page, index) in suggestions"
            :key="page.key + (page.header ? `_${page.header.slug}` : '')"
            class="flex px-4 py-2 text-lg font-semibold text-gray-700 hover:text-gray-700 rounded cursor-pointer border-0"
            :class="index === focused ? 'bg-topaz' : ''"
            :href="! dragged && page.path"
            @click="! dragged && go($event, index)"
            @mouseenter="focus(index)"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path class="primary" d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm2 3a1 1 0 0 0-1 1v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7z"/><path class="secondary" d="M7 14h10a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1zm7-8h3a1 1 0 0 1 0 2h-3a1 1 0 0 1 0-2zm0 4h3a1 1 0 0 1 0 2h-3a1 1 0 0 1 0-2z"/></svg>
            <div class="ml-2 flex-no-shrink" v-for="tag in $page.frontmatter.tags" v-text="`${tag}`"></div>
            <div :class="index === focused ? 'text-white' : ''">
                <div v-text="page.title"></div>
                <span v-if="page.header" class="text-sm">&rightarrow;&nbsp;{{ page.header.title }}</span>
            </div>
        </a>

        <!-- No results -->
        <div
            v-if="query && suggestions.length === 0"
            class="p-6 text-center text-gray-700"
            v-text="`I'm Old Gregg...`"
        ></div>
    </div>
</template>

<script>
import { isArticle } from '@theme/utils'

export default {
    props: ['suggestions', 'query', 'focused', 'dragged'],
    inject: ['focus', 'unfocus', 'go'],
    methods: {
        iconForPage (page) {
            switch (true) {
                case !! page.frontmatter.icon:
                    return page.frontmatter.icon
                case isArticle(page):
                    return 'news'
                default:
                    return 'document'
            }
        }
    }
}
</script>
