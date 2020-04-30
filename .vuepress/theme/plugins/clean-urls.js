module.exports = ({
      normalSuffix = '',
      indexSuffix = '',
      notFoundPath = '/404.html',
  }, ctx) => ({
    name: 'clean-urls',
    extendPageData(page) {
        const { regularPath, frontmatter = {} } = page
        if (regularPath === '/404.html') {
            // path for 404 page
            page.path = notFoundPath
        } else if (regularPath.endsWith('.html')) {
            // normal path
            // e.g. foo/bar.md -> foo/bar.html
            page.path = regularPath.slice(0, -5) + normalSuffix
            frontmatter.permalink = regularPath.slice(0, -5) + normalSuffix
        } else if (regularPath.endsWith('/')) {
            // index path
            // e.g. foo/index.md -> foo/
            page.path = regularPath.slice(0, -1) + indexSuffix
            frontmatter.permalink = regularPath.slice(0, -5) + indexSuffix
        }
    }
})
