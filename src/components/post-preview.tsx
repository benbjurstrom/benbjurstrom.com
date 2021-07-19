import Link from 'next/link'

import Author from '@/types/author'
import DateFormatter from '@/components/date-formatter'

type Props = {
  title: string
  coverImage: string
  date: string
  excerpt: string
  author: Author
  slug: string
}

const PostPreview = ({ title, coverImage, date, excerpt, author, slug }: Props): JSX.Element => {
  return (
    <section>
      <Link as={`/${slug}`} href="/[slug]">
        <a className="inline-block p-4 hover:bg-gray-200">
          <div className="mb-1">
            <div className="flex-grow text-gray-800 font-serif text-lg font-semibold">{title}</div>
            <div className="my-2 text-sm italic font-light md:my-0">
              <DateFormatter dateString={date} />
            </div>
          </div>
          <div>{excerpt}</div>
        </a>
      </Link>
    </section>
  )
}

export default PostPreview
