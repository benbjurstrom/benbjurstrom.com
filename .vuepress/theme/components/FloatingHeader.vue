<template>
    <div class="floating-header fixed inset-x-0 top-0 pt-2 pb-3 sm:pt-3 sm:pb-4 shadow z-floating-header" :class="{ 'active': isVisible }">
        <div class="container-lg">
            <div class="flex items-center">

                <!-- Home and Title -->
                <div class="flex-1 flex items-center">
                    <router-link to="/" class="block border-0 text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path class="primary" d="M9 22H5a1 1 0 0 1-1-1V11l8-8 8 8v10a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v4a1 1 0 0 1-1 1zm3-9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path class="secondary" d="M12.01 4.42l-8.3 8.3a1 1 0 1 1-1.42-1.41l9.02-9.02a1 1 0 0 1 1.41 0l8.99 9.02a1 1 0 0 1-1.42 1.41l-8.28-8.3z"/></svg>
                    </router-link>
                    <div
                        v-text="$page.title"
                        class="flex-1 font-serif font-medium ml-3 mr-4 w-5 h-5 truncate"
                    ></div>
                </div>

                <!-- Share section -->
                <div class="sm:flex items-center">
                    <!-- <Navigator /> -->
                </div>
            </div>
        </div>
        <GradientBar :progress="progress" class="absolute inset-x-0 bottom-0 h-1" />
    </div>
</template>

<script>
import GradientBar from '@theme/components/GradientBar'
import Navigator from '@theme/components/Navigator'

export default {
    components: { GradientBar, Navigator },
    data () {
        return {
            progressValue: 0,
            progressMax: 0,
        }
    },
    computed: {
        progress () {
            if (this.progressMax === 0) return 0
            const percent = Math.floor(this.progressValue / this.progressMax * 1000) / 10
            return Math.min(percent, 100)
        },
        isVisible () {
            return true
        },
            absoluteUrl () {
                return this.$themeConfig.domain + this.$page.path
            },
            encodedTitle () {
                return encodeURIComponent(this.$page.title)
            },
    },
    methods: {
        update () {
            const content = document.querySelector('.content')
            const progressValue = window.scrollY
            const progressMax = content.scrollHeight + content.offsetTop - window.innerHeight
            this.progressMax = progressMax
            this.progressValue = progressValue
        },
    },
    mounted () {
        this.update()
        window.addEventListener('scroll', this.update, { passive: true })
        window.addEventListener('resize', this.update, false)
    },
    beforeDestroy () {
        window.removeEventListener('scroll', this.update)
        window.removeEventListener('resize', this.update)
    },
}
</script>

<style lang="stylus">
.floating-header
    visibility hidden
    background rgba(255,255,255,0.95)
    transition all 500ms cubic-bezier(0.19, 1, 0.22, 1)
    transform translate3d(0, -120%, 0)
    &.active
        visibility visible
        transition all 500ms cubic-bezier(0.22, 1, 0.27, 1)
        transform translate3d(0, 0, 0)
</style>
