<template>
    <div>
        <h1 class="my-8">Projects</h1>
        <template v-for="project in projects">
            <hr>
            <a :href="project.url"
               :key="project.title"
               target="_blank"
               class="block py-6 hover:bg-gray-200 border-b border-t border-transparent hover:border-gray hover:text-black"
            >
                <div class="md:flex">
                    <div class="w-1/4 md:mr-4">
                        <img class="object-contain h-48" :src="project.image" alt="">
                    </div>
                    <div class="w-3/4">
                        <div class="text-lg text-gray-800 font-serif font-semibold">{{project.title}}</div>
                        <div class="mb-1 text-sm italic font-light">{{project.url}}</div>
                        <div class="">
                            {{project.body}}
                        </div>
                    </div>
                </div>
            </a>
        </template>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                projects: [
                    {
                      title: 'Mealpractice: Build your practice and share it with the world!',
                      url: 'https://www.mealpractice.com',
                      image: 'https://mealpractice-public.s3.us-west-2.amazonaws.com/assets/logo.svg',
                      body: 'Mealpractice makes it easy to cook and share the recipes you love. Discover new recipes by following practitioners with similar tastes or nutritional goals.'
                    },
                    {
                        title: 'Astrify: Create custom stellar.toml files in seconds!',
                        url: 'https://astrify.com',
                        image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/astrify.png',
                        body: 'Astrify makes it easy to publish assets on the stellar network. Add your organization\'s information to a custom stellar.toml file. Accounts, assets, validators, and principals that are linked to the organization will show up in real time.'
                    },
                    {
                        title: 'Prezet: An opinionated Laravel preset with Inertia.js and Vuetify',
                        url: 'https://github.com/benbjurstrom/prezet-laravel-intertia-vuetify',
                        image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/prezet.png',
                        body: 'My goal with this project is to create an opinionated boilerplate that I can use to get working on a new idea right away without getting bogged down in all the cruft involved in setting up a new web app.'
                    },
                    {
                        title: 'Webconcepts Youtube Channel',
                        url: 'https://www.youtube.com/c/webconcepts',
                        image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/web-concepts.png',
                        body: 'A youtube channel covering various concepts related to web development. My goal with this channel is to provide quick overviews and examples to bring awareness to the topic.'
                    },
                    {
                        title: 'Personal Youtube Channel',
                        url: 'https://www.youtube.com/c/benbjurstrom',
                        image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/benbjurstrom.png',
                        body: 'A youtube channel with videos about cameras, tech, and whatever else catches my interest.'
                    }
                ],
            }
        },
    }
</script>
