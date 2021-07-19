type Props = {
  name: string
  picture: string
}

const Avatar = ({ name, picture }: Props): JSX.Element => {
  return (
    <div className="flex items-center">
      <img src={picture} className="mr-4 w-12 h-12 rounded-full" alt={name} />
      <div className="text-xl font-bold">{name}</div>
    </div>
  )
}

export default Avatar
