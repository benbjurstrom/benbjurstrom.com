import { FunctionComponent, ReactNode } from 'react'

type Props = {
  children?: ReactNode
}

const Container: FunctionComponent = ({ children }: Props): JSX.Element => {
  return <div className="container mx-auto px-5 max-w-3xl">{children}</div>
}

export default Container
