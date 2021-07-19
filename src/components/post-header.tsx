import Author from '@/types/author'
import { CalendarIcon } from '@heroicons/react/outline'

import Avatar from '@/components/avatar'
import CoverImage from '@/components/cover-image'
import DateFormatter from '@/components/date-formatter'

type Props = {
  title: string
  coverImage: string
  date: string
  author: Author
}

const PostHeader = ({ title, coverImage, date, author }: Props): JSX.Element => {
  return (
    <>
      <h1 className="mb-1 text-3xl font-bold tracking-tight leading-tight md:mb-4 md:text-left md:text-4xl md:leading-none lg:text-6xl">
        {title}
      </h1>
      <div className="flex mb-12 text-gray-600 text-sm italic">
        <CalendarIcon className="mr-1.5 w-5 h-5" aria-hidden="true" />
        <DateFormatter dateString={date} />
      </div>
      {coverImage ? (
        <div className="mb-8 sm:mx-0 md:mb-16">
          <CoverImage title={title} src={coverImage} />
        </div>
      ) : (
        ''
      )}
    </>
  )
}

export default PostHeader
