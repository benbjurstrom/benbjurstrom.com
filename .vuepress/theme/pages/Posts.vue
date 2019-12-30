<template>
    <div>
        <h1 class="my-8 mx-6">Blog Posts</h1>
        <router-link
            v-for="article in $articles"
            :key="article.key"
            :to="article.path"
            class="block py-6 hover:bg-gray-200 border-b border-t border-transparent hover:border-gray hover:text-black"
        >
            <div class="px-6">
                <h2
                    class="font-sans text-2xl text-gray-900 font-semibold mb-1"
                    v-text="article.title"
                />
                <div
                    class="font-content text-gray-700"
                    v-text="article.frontmatter.description"
                />
                <span class="text-gray-600 text-sm italic" v-text="new Date(article.frontmatter.date).toLocaleDateString('en-US')"/>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        //
    }
</script>
