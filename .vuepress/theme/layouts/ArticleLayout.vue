<template>
    <div class="w-full my-12 md:mx-auto lg:pb-20 md:max-w-lg lg:max-w-4xl">
        <ArticleHeader class="mx-4"/>
        <div class="container">
            <Content class="content" />
        </div>
        <div class="mx-4">
            <ClientOnly>
                <div id="commento"></div>
                <script src="https://cdn.commento.io/js/commento.js"></script>
            </ClientOnly>
        </div>
    </div>
</template>

<script>
    import ArticleHeader from '@theme/components/ArticleHeader'

    export default {
        components: { ArticleHeader },
        computed: {
            //
        }
    }
</script>

