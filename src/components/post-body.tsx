import { MDXRemote, MDXRemoteSerializeResult } from 'next-mdx-remote'
import dynamic from 'next/dynamic'
import ContentImage from '@/components/ContentImage'

type Props = {
  content: MDXRemoteSerializeResult
}

// Custom components/renderers to pass to MDX.
// Since the MDX files aren't loaded by webpack, they have no knowledge of how
// to handle import statements. Instead, you must include components in scope
// here.
const components = {
  YouTube: dynamic(() => import('@/components/youtube')),
  ImageModal: dynamic(() => import('@/components/image-modal')),
  code: dynamic(() => import('@/components/code-block')),
  img: ContentImage,
}

const PostBody = ({ content }: Props): JSX.Element => {
  return (
    <div className="mx-auto max-w-3xl">
      <div className="prose prose-lg">
        <MDXRemote {...content} components={components} />
      </div>
    </div>
  )
}

export default PostBody
