<template>
    <div class="flex flex-col sm:flex-row sm:items-center text-gray-600 font-semibold bg-gray-100 border-t border-b border-gray px-4 py-2 overflow-hidden">
        <div class="flex flex-no-shrink items-center mb-2 sm:mb-0 sm:mr-6 text-gray">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path class="primary" d="M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm0 5v10h14V9H5z"/><path class="secondary" d="M7 2a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1zm10 0a1 1 0 0 1 1 1v3a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1z"/></svg>
            <div class="ml-2 flex-no-shrink" v-text="new Date($page.frontmatter.date).toLocaleDateString('en-GB')"></div>
        </div>
        <div class="flex flex-no-shrink items-center text-gray">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path class="primary" d="M2.59 13.41A1.98 1.98 0 0 1 2 12V7a5 5 0 0 1 5-5h4.99c.53 0 1.04.2 1.42.59l8 8a2 2 0 0 1 0 2.82l-8 8a2 2 0 0 1-2.82 0l-8-8zM7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path class="secondary" d="M12 18l6-6-4-4-6 6.01L12 18z"/></svg>
            <div class="ml-2 flex-no-shrink" v-for="tag in $page.frontmatter.tags" v-text="`${tag}`"></div>
        </div>
    </div>
</template>

<script>
export default {
    //
}
</script>
