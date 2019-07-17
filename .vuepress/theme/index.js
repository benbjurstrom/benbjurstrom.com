const path = require('path')

module.exports = {
	plugins: {
        '@vuepress/google-analytics': { ga: 'UA-XXXXXXXXX-4' },
        'seo': true,
        'disqus': true,
    },
    enhanceAppFiles: [
        path.resolve(__dirname, 'articles.js'),
        path.resolve(__dirname, 'search.js'),
    ]
}
