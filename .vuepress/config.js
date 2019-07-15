const removeMd = require('remove-markdown')

module.exports = {
  title: 'VuePress Blog Example',
  description: 'This is a blog example built by VuePress',
  plugins: [
    '@vuepress/plugin-nprogress',
    [
      '@vuepress/blog',
      {
        directories: [
          {
            id: 'post',
            dirname: '_posts',
            path: '/',
            // layout: 'IndexPost', defaults to `Layout.vue`
            itemLayout: 'Post',
            itemPermalink: '/:year/:month/:day/:slug',
            pagination: {
              lengthPerPage: 5,
            },
          },
        ],
        frontmatters: [
          {
            id: "tag",
            keys: ['tag', 'tags'],
            path: '/tag/',
            // layout: 'Tag',  defaults to `FrontmatterKey.vue`
            frontmatter: { title: 'Tag' },
            pagination: {
              lengthPerPage: 5
            }
          },
        ]
      }
    ],
    ['@vuepress/medium-zoom', true],
    ['@vuepress/search', {
      searchMaxSuggestions: 10
    }],
  ],
  themeConfig: {
    /**
     * Ref: https://vuepress-theme-blog.ulivz.com/#nav
     */
    nav: [
      {
        text: 'Blog',
        link: '/',
      },
      {
        text: 'Tags',
        link: '/tag/',
      },
      {
        text: 'About',
        link: '/about/',
      },
    ],
    /**
     * Ref: https://vuepress-theme-blog.ulivz.com/#footer
     */
    footer: {
      contact: [
        {
          type: 'github',
          link: 'https://github.com/ulivz',
        },
        {
          type: 'twitter',
          link: 'https://twitter.com/_ulivz',
        },
      ],
      copyright: [
        {
          text: 'Privacy Policy',
          link: 'https://policies.google.com/privacy?hl=en-US',
        },
        {
          text: 'MIT Licensed | Copyright © 2018-present Vue.js',
          link: '',
        },
      ],
    },

    // paginationComponent: 'SimplePagination'
  },
  define: {
    THEME_BLOG_PAGINATION_COMPONENT: 'Pagination'
  },
  extendPageData: function (pageCtx) {
    const strippedContent = pageCtx._strippedContent
    if (!strippedContent) {
      return
    }
    pageCtx.summary = removeMd(
        strippedContent
        .trim()
        .replace(/^#+\s+(.*)/, '')
        .slice(0, 200)
    ) + ' ...'
  }
}
