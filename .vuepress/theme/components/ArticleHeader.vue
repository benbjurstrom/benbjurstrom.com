<template>
    <div>
        <div class="flex justify-end">
            <div class="text-sm italic text-gray-600">
                <div class="flex flex-no-shrink items-center sm:mb-0 sm:mr-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-current">
                        <path class="primary" d="M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2zm0 5v10h14V9H5z"/>
                        <path class="secondary" d="M7 2a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0V3a1 1 0 0 1 1-1zm10 0a1 1 0 0 1 1 1v3a1 1 0 0 1-2 0V3a1 1 0 0 1 1-1z"/>
                    </svg>
                    <div class="ml-2 flex-no-shrink" v-text="new Date($page.frontmatter.date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })"></div>
                </div>
            </div>
        </div>
        <h1 class="mt-8">{{$page.title}}</h1>
        <nav class="text-gray-600 mt-2" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <router-link class="hover:text-gray-900" to="/">Home</router-link>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li class="flex items-center">
                    <router-link class="hover:text-gray-900" to="/posts">Posts</router-link>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                </li>
                <li>
                    <span class="text-gray-500" aria-current="page">{{$page.frontmatter.permalink}}</span>
                </li>
            </ol>
        </nav>
        <!--
        <div class="text-sm italic text-gray-600">
            <div class="flex flex-no-shrink items-center text-gray">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5 fill-current"><path class="primary" d="M2.59 13.41A1.98 1.98 0 0 1 2 12V7a5 5 0 0 1 5-5h4.99c.53 0 1.04.2 1.42.59l8 8a2 2 0 0 1 0 2.82l-8 8a2 2 0 0 1-2.82 0l-8-8zM7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/><path class="secondary" d="M12 18l6-6-4-4-6 6.01L12 18z"/></svg>
                <div class="ml-2 flex-no-shrink" v-for="tag in $page.frontmatter.tags" v-text="`${tag}`"></div>
            </div>
        </div>
        -->
    </div>
</template>

<script>
export default {
    //
}
</script>
