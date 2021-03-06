module.exports = {
	title: 'Ben Bjurstorm',
	permalink: '/posts/:slug.html',
	themeConfig: {
		domain: 'https://benbjurstrom.com',
		repo: 'https://github.com/benbjurstrom/benbjurstrom',
		nav: [ '/' ],
		author: {
			name: 'Ben Bjurstrom',
			twitter: '@benbjurstrom',
		},
	},
	plugins: [
		['@vuepress/google-analytics', {'ga': 'UA-98425034-1'}],
		['seo', true]
		// require('./theme/plugins/clean-urls.js'),
	],
	postcss: {
		plugins: [
			require('tailwindcss')('./tailwind.config.js'),
			require('autoprefixer'),
		]
	},
	head: [
		// TODO: ['script', { type: 'application/ld+json' }, JSON.stringify({})],
		['link', { rel: 'apple-touch-icon', sizes: '180x180', href: '/apple-icon.png' }],
		['link', { rel: 'icon', type: 'image/png', sizes: '192x192', href: '/android-chrome-192x192.png' }],
		['link', { rel: 'icon', type: 'image/png', sizes: '192x192', href: '/android-chrome-512x512.png' }],
		['link', { rel: 'icon', type: 'image/png', sizes: '32x32', href: '/favicon-32x32.png' }],
		['link', { rel: 'icon', type: 'image/png', sizes: '16x16', href: '/favicon-16x16.png' }],
		['link', { rel: 'manifest', href: '/site.webmanifest' }]
	]
}
