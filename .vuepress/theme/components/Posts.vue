<template>
    <div>
        <h1 class="my-8">Recent Blog Posts</h1>
        <template v-for="article in articles">
            <hr>
            <router-link
                :key="article.key"
                :to="article.path"
                class="block py-6 hover:bg-gray-200 border-b border-t border-transparent hover:border-gray hover:text-black"
            >
            <div class="flex mb-1">
                <div class="flex-grow text-lg text-gray-800 font-serif font-semibold">{{article.title}}</div>
                <div class="text-sm italic font-light" v-text="new Date(article.frontmatter.date).toLocaleDateString('en-US')" />
            </div>
            <div>
                {{article.frontmatter.description}}
            </div>
            </router-link>
        </template>
    </div>
</template>

<script>
    import { isArticle, sortByDate, isFeatured } from '@theme/util'
    export default {
        computed: {
            articles () {
                return this.$site.pages
                .filter(isArticle)
                .filter(isFeatured)
                .sort(sortByDate)
            }
        }
    }
</script>
