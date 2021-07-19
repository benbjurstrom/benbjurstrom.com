import Link from 'next/link'
import * as React from 'react'

const Header = (): JSX.Element => {
  return (
    <h2 className="mb-20 mt-8 text-2xl font-bold tracking-tight leading-tight md:text-4xl md:tracking-tighter">
      <Link href="/blog">
        <a className="flex inline-block items-center hover:underline">
          <img
            className="mr-2 w-8 h-8 rounded-full sm:w-9 sm:h-9"
            src="https://s3.us-west-2.amazonaws.com/benbjurstrom.com/img/headshot.jpg"
            alt=""
          />
          Blog .
        </a>
      </Link>
    </h2>
  )
}

export default Header
