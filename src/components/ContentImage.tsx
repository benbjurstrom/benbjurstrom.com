import React from 'react'
import Image from 'next/image'

type Props = {
  src: string
}

export default function ContentImage({ src }: Props) {
  return (
    <div className="aspect-w-16 aspect-h-9 relative">
      <div className="absolute text-center">
        <div className="flex place-content-center">
          <p>Loading Image...</p>
        </div>
      </div>
      <Image
        className="object-scale-down"
        layout="fill"
        placeholder="blur"
        blurDataURL="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNcv3V3PQAG2gKg3UbuXwAAAABJRU5ErkJggg=="
        src={src}
      />
    </div>
  )
}
