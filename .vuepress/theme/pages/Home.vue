<template>
    <div>
        <div class="px-12 pb-12 mt-10 lg:pb-20 max-w-xl mx-auto md:max-w-2xl lg:max-w-5xl">
            <Posts class="mb-12"/>
            <Projects />
        </div>
    </div>
</template>

<script>
    import Posts from '@theme/components/Posts'
    import Projects from '@theme/components/Projects'

    export default {
        components: {
            Posts,
            Projects
        },
        //
    }
</script>
