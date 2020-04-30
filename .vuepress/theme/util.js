export const isArticle = page => {
    if (page.regularPath){
        return page.regularPath.startsWith('/articles/')
            && page.regularPath !== '/articles/'
    }

    return false
}

export const isFeatured = page => {
    if (page.frontmatter){
        return page.frontmatter.featured
    }

    return false
}

export const sortByDate = (a, b) =>
    new Date(b.frontmatter.date) - new Date(a.frontmatter.date)
