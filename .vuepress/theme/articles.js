import { isArticle, sortByDate, fetchPagesInArray, excludePages } from '@theme/utils'

export default ({ Vue }) => {
    Vue.mixin({
        computed: {
            $articles () {
                return this.$site.pages
                    .filter(isArticle)
                    .sort(sortByDate)
            }
        }
    })
}
