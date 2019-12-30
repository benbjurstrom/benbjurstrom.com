<template>
    <div id="global-layout" class="font-sans antialiased min-h-screen text-gray-900 md:flex">
        <div class="sticky bg-gray-800 md:h-screen md:w-72 md:top-0">
            <Sidebar />
        </div>
        <component :is="layout"/>
    </div>
</template>

<script>
    import { isArticle } from '@theme/utils'
    import Sidebar from '@theme/components/Sidebar'
    import ArticleLayout from '@theme/layouts/ArticleLayout'
    import DefaultLayout from '@theme/layouts/DefaultLayout'
    export default {
        components: {
            Sidebar,
            DefaultLayout,
            ArticleLayout,
        },
        name: 'GlobalLayout',
        computed: {
            layout () {
                if (isArticle(this.$page)) {
                    return 'ArticleLayout'
                }

                return 'DefaultLayout'
            }
        },
    }
</script>
