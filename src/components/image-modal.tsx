import React from 'react'
import Modal from '@/components/modal'
import Image from 'next/image'

type Props = {
  url: string
  title?: string
  subtitle?: string
}

export default function ImageModal({ url, title, subtitle }: Props) {
  const [showModal, setShowModal] = React.useState(false)

  return (
    <div>
      <div className="relative w-48">
        <div className="group aspect-w-16 aspect-h-9 block w-full bg-gray-100 rounded-lg overflow-hidden ring-1 focus-within:ring-2 ring-indigo-100 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
          <Image
            src={url}
            className="mb-0 mt-0 group-hover:opacity-75 pointer-events-none object-cover object-left-top"
            layout="fill"
            placeholder="blur"
            blurDataURL="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNcv3V3PQAG2gKg3UbuXwAAAABJRU5ErkJggg=="
          />
          <button type="button" className="absolute inset-0 focus:outline-none" onClick={() => setShowModal(true)}>
            <span className="sr-only">View details for {title}</span>
          </button>
        </div>
      </div>
      <div className="mt-2 text-gray-500 text-sm font-medium pointer-events-none">
        {title ? <span>{title}</span> : ''}
        {subtitle ? <span className="">: {subtitle}</span> : ''}
      </div>

      <Modal isOpen={showModal} setIsOpen={setShowModal} title={title} subtitle={subtitle}>
        <img className="w-full" src={url} alt="" />
      </Modal>
    </div>
  )
}
