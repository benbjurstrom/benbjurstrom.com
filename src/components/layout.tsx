import Sidebar from '@/components/layout/Sidebar'

type Props = {
  children: React.ReactNode
}

const Layout = ({ children }: Props): JSX.Element => {
  return (
    <>
      <div className="text-gray-900 font-sans antialiased overflow-hidden md:flex md:h-screen">
        <div className="sticky bg-gray-800 md:flex md:flex-shrink-0">
          <div className="flex flex-col justify-between md:w-72">
            <Sidebar />
          </div>
        </div>
        <main className="mb-12 w-full md:overflow-y-auto">{children}</main>
      </div>
    </>
  )
}

export default Layout
