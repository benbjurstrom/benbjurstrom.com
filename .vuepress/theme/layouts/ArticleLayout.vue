<template>
    <div class="my-12 w-full">
        <ArticleHeader class="mx-4 md:mx-auto md:max-w-lg lg:max-w-3xl xl:max-w-4xl"/>
        <Content class="mt-8 mx-auto content" />
        <!--<div class="mt-8 mx-4 md:mx-auto md:max-w-lg lg:max-w-3xl xl:max-w-4xl">
            <ClientOnly>
                <div id="commento"></div>
                <script src="https://cdn.commento.io/js/commento.js"></script>
            </ClientOnly>
        </div>-->
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

