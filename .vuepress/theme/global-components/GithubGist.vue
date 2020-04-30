<template>
    <div class="my-4">
        <p v-html="div"></p>
    </div>
</template>
<script>

const jsonp = require('jsonp');
export default {
    props: {
        url: {
            type: String,
            required: true
        }
    },
    data () {
        return {
            div: null,
        }
    },
    mounted() {
        this.getGistData();
    },
    methods: {
        getGistData() {
            jsonp(this.url, null, (err, data) => {
                if (err) {
                    console.error(err.message);
                } else {
                    this.div = data.div
                }
            })
        }
    },
};
</script>
<style scoped>
    @import url("https://github.githubassets.com/assets/gist-embed-31007ea0d3bd9f80540adfbc55afc7bd.css");
</style>
<style>
    .gist-data {
        max-height: 24rem;
    }
    table.highlight.tab-size.js-file-line-container {
        max-width: 100% !important;
    }
</style>
