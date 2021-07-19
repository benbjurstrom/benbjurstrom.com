import { Dialog, Transition } from '@headlessui/react'
import { XIcon } from '@heroicons/react/outline'
import React, { Fragment, ReactNode, SetStateAction } from 'react'

export default function Modal({
  isOpen,
  setIsOpen,
  title,
  subtitle,
  children,
}: {
  isOpen: boolean
  setIsOpen: React.Dispatch<SetStateAction<boolean>>
  title?: string
  subtitle?: string
  children: ReactNode
}): JSX.Element {
  return (
    <Transition.Root show={isOpen} as={Fragment}>
      <Dialog as="div" static className="fixed z-10 inset-0 overflow-y-auto" open={isOpen} onClose={setIsOpen}>
        <div className="flex items-start justify-center pb-20 pt-4 px-4 min-h-screen text-center sm:block sm:p-0">
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0"
            enterTo="opacity-100"
            leave="ease-in duration-200"
            leaveFrom="opacity-100"
            leaveTo="opacity-0"
          >
            <Dialog.Overlay className="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
          </Transition.Child>

          {/* This element is to trick the browser into centering the modal contents. */}
          <span className="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">
            &#8203;
          </span>
          <Transition.Child
            as={Fragment}
            enter="ease-out duration-300"
            enterFrom="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            enterTo="opacity-100 translate-y-0 sm:scale-100"
            leave="ease-in duration-200"
            leaveFrom="opacity-100 translate-y-0 sm:scale-100"
            leaveTo="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
          >
            <div className="inline-block flex-grow align-bottom pt-5 text-left bg-white rounded-lg shadow-xl overflow-hidden transform transition-all sm:align-middle sm:my-8 sm:p-6 sm:w-full sm:max-w-4xl">
              <div className="absolute right-0 top-0 pr-4 pt-4 sm:block">
                <button
                  type="button"
                  className="text-gray-400 hover:text-gray-500 bg-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                  onClick={() => setIsOpen(false)}
                >
                  <span className="sr-only">Close</span>
                  <XIcon className="w-6 h-6" aria-hidden="true" />
                </button>
              </div>
              <div className="sm:flex sm:items-start">
                <div className="flex-grow mt-3 mx-2 sm:mt-0 sm:mx-4">
                  {title ? (
                    <Dialog.Title
                      as="h3"
                      className="border-b-grey text-gray-900 text-lg font-medium leading-6 border-b"
                    >
                      <div>{title}</div>
                      <div>{subtitle ? <span className="text-md text-gray-700 font-normal">{subtitle}</span> : ''}</div>
                    </Dialog.Title>
                  ) : (
                    ''
                  )}
                  <div className="mt-2">{children}</div>
                </div>
              </div>
            </div>
          </Transition.Child>
        </div>
      </Dialog>
    </Transition.Root>
  )
}
