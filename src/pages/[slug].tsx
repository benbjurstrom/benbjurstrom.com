import ErrorPage from 'next/error'
import { useRouter } from 'next/router'
import { NextSeo } from 'next-seo'
import * as React from 'react'
import RemarkUnwrapImages from 'remark-unwrap-images'

import { serialize } from 'next-mdx-remote/serialize'

import Container from '@/components/container'
import Header from '@/components/header'
import Layout from '@/components/layout'
import PostBody from '@/components/post-body'
import PostHeader from '@/components/post-header'
import { getAllPosts, getPostBySlug } from '@/lib/getPosts'
import PostType from '@/types/post'

type Props = {
  post: PostType
  morePosts: PostType[]
  preview?: boolean
}

const Post = ({ post }: Props) => {
  const router = useRouter()

  if (!router.isFallback && !post?.slug) {
    return <ErrorPage statusCode={404} />
  }

  if(router.isFallback){
    return (
      <Layout>
        <Container>
          <span>Loading…</span>
        </Container>
      </Layout>
    )
  }

  return (
    <>
      <NextSeo
        title={post.title}
        description={post.excerpt}
        canonical={'https://benbjurstrom.com' + router.asPath}
        openGraph={{
          url: '/' + post.slug,
          title: post.title,
          description: post.excerpt,
          images: [
            {
              url: post.ogImage.url,
              width: 800,
              height: 600,
              alt: 'Og Image Alt',
            },
          ],
        }}
      />
      <Layout>
        <Container>
          <article className="mb-32 mt-12">
            <PostHeader title={post.title} coverImage={post.coverImage} date={post.date} author={post.author} />
            <PostBody content={post.content} />
          </article>
        </Container>
      </Layout>
    </>
  )
}

export default Post

type Params = {
  params: {
    slug: string
  }
}

export async function getStaticProps({ params }: Params) {
  const post = getPostBySlug(params.slug, ['title', 'excerpt', 'date', 'slug', 'author', 'content', 'ogImage', 'coverImage'])

  const mdxSource = await serialize(post.content, {
    // Optionally pass remark/rehype plugins
    mdxOptions: {
      remarkPlugins: [RemarkUnwrapImages],
      rehypePlugins: [],
    },
  })

  return {
    props: {
      post: {
        ...post,
        content: mdxSource,
      },
    },
  }
}

export async function getStaticPaths() {
  const posts = getAllPosts(['slug'])

  return {
    paths: posts.map((post) => {
      return {
        params: {
          slug: post.slug,
        },
      }
    }),
    fallback: false,
  }
}
