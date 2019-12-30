const path = require('path')

module.exports = {
	plugins: {
        'minimal-analytics': { ga: ' UA-98425034-1' },
        'seo': true,
    },
    enhanceAppFiles: [
        path.resolve(__dirname, 'articles.js')
    ]
}
