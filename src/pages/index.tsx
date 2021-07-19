import { NextSeo } from 'next-seo'
import * as React from 'react'

import Container from '@/components/container'
import PostPreview from '@/components/post-preview'
import Intro from '@/components/intro'
import Layout from '@/components/layout'
import MoreStories from '@/components/more-stories'
import { getAllPosts } from '@/lib/getPosts'
import Post from '@/types/post'
import Projects from '@/components/Projects'

type Props = {
  allPosts: Post[]
}

const Index = ({ allPosts }: Props) => {
  return (
    <>
      <Layout>
        <NextSeo title="Blog" />
        <Container>
          <h2 className="mb-4 mt-12 font-serif text-3xl font-bold">Blog Posts</h2>
          {allPosts.map((post) => (
            <PostPreview
              key={post.slug}
              title={post.title}
              coverImage={post.coverImage}
              date={post.date}
              author={post.author}
              slug={post.slug}
              excerpt={post.excerpt}
            />
          ))}
          <h2 className="mb-4 mt-12 font-serif text-3xl font-bold">Projects</h2>
          <Projects />
        </Container>
      </Layout>
    </>
  )
}

export default Index

export const getStaticProps = async () => {
  const allPosts = getAllPosts(['title', 'date', 'slug', 'author', 'coverImage', 'excerpt'])

  return {
    props: { allPosts },
  }
}
