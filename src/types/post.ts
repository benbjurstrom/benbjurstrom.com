import Author from './author'
import { MDXRemoteSerializeResult } from 'next-mdx-remote'

type PostType = {
  slug: string
  title: string
  date: string
  coverImage: string
  author: Author
  excerpt: string
  ogImage: {
    url: string
  }
  content: MDXRemoteSerializeResult
}

export default PostType
