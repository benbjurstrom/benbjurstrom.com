import { Tweet } from 'react-twitter-widgets'

const TweetEmbed = ({tweetId}: { tweetId: string }): JSX.Element => {
  return (
    <Tweet tweetId={tweetId} />
  )
}

export default TweetEmbed
