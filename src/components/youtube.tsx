const PostBody = ({ url }: { url: string }): JSX.Element => {
  return (
    <div className="aspect-w-16 aspect-h-9">
      <iframe
        src={url}
        frameBorder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowFullScreen
      />
    </div>
  )
}

export default PostBody
