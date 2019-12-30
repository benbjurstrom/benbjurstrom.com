<template>
    <div class="w-full my-12 md:mx-auto lg:pb-20 md:max-w-xl lg:max-w-5xl">
        <component :is="page"/>
    </div>
</template>

<script>
    import Home from '@theme/pages/Home'
    import Posts from '@theme/pages/Posts'
    import Projects from '@theme/pages/Projects'
    import NotFound from '@theme/pages/NotFound'

    export default {
        components: {
            Home,
            Posts,
            Projects,
            NotFound
        },
        computed: {
            page () {
                if (this.$page.path === '/') return 'Home'
                if (this.$page.frontmatter.page === 'Posts') return 'Posts'
                if (this.$page.frontmatter.page === 'Projects') return 'Projects'
                return 'NotFound'
            }
        },
    }
</script>

