import Link from 'next/link'
import * as React from 'react'

const Intro = (): JSX.Element => {
  return (
    <section className="flex flex-col items-center mb-16 mt-16 md:flex-row md:justify-between md:mb-12">
      <Link href="/">
        <a>
          <img
            className="w-12 h-12 rounded-full md:w-24 md:h-24"
            src="https://s3.us-west-2.amazonaws.com/benbjurstrom.com/img/headshot.jpg"
            alt=""
          />
        </a>
      </Link>
      <h1 className="text-6xl font-bold tracking-tighter leading-tight md:pr-8 md:text-8xl">Blog.</h1>
      <h4 className="mt-5 text-center text-lg md:pl-8 md:text-left">A personal website.</h4>
    </section>
  )
}

export default Intro
