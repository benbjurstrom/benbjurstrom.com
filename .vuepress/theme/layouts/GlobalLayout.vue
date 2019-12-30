<template>
    <div class="font-sans antialiased min-h-screen text-gray-900 md:flex">
        <div class="sticky bg-gray-800 md:h-screen md:w-72 md:top-0">
            <Sidebar />
        </div>
        <component :is="layout"/>
    </div>
</template>

<script>
    import { setGlobalInfo } from '@app/util'
    import { isArticle } from '@theme/util'
    import Sidebar from '@theme/components/Sidebar'
    import ArticleLayout from '@theme/layouts/ArticleLayout'
    import Layout from '@theme/layouts/Layout'
    export default {
        components: {
            Sidebar,
            Layout,
            ArticleLayout,
        },
        name: 'GlobalLayout',
        computed: {
            layout () {
                if (isArticle(this.$page)) {
                    setGlobalInfo('layout', 'ArticleLayout')
                    return 'ArticleLayout'
                }

                return 'Layout'
            },
        },
        mounted () {
            const canonical = `<link rel='canonical' href='${this.$page.path}'/>`
            if (typeof this.$ssrContext !== 'undefined') {
                console.log(this.$ssrContext)
                this.$ssrContext.userHeadTags+=canonical
            }
        }
    }
</script>
