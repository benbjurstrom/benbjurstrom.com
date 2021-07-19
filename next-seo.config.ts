export default {
  dangerouslySetAllPagesToNoFollow:
    process.env.NEXT_PUBLIC_VERCEL_ENV !== 'production',
  dangerouslySetAllPagesToNoIndex:
    process.env.NEXT_PUBLIC_VERCEL_ENV !== 'production',
  defaultTitle: 'Ben Bjurstrom',
  titleTemplate: 'Ben Bjurstrom | %s',
  description:
    'Personal website belonging to Ben Bjurstrom.',
  openGraph: {
    type: 'website',
    title: 'Ben Bjurstrom',
    url: 'https://benbjurstrom.com',
    site_name: 'Ben Bjurstrom',
    locale: 'en_US',
    images: [
      {
        url: 'https://s3.us-west-2.amazonaws.com/benbjurstrom.com/img/headshot.jpg',
        width: 1200,
        height: 630,
        alt: 'Ben Bjurstrom Headshot',
      },
    ],
  },
  twitter: {
    handle: '@benbjurstrom',
    cardType: 'summary_large_image',
  },
  additionalLinkTags: [
    {
      rel: 'icon',
      href: '/favicon/favicon.svg',
      type: 'image/svg+xml',
    },
    {
      rel: 'alternate icon',
      href: '/favicon/favicon.ico',
    },
    {
      rel: 'apple-touch-icon',
      sizes: '180x180',
      href: '/favicon/apple-touch-icon.png',
    },
    {
      rel: 'icon',
      sizes: '32x32',
      type: 'image/png',
      href: '/favicon/favicon-32x32.png',
    },
    {
      rel: 'manifest',
      href: '/favicon/site.webmanifest',
    },
    {
      rel: 'mask-icon',
      href: '/favicon/safari-pinned-tab.svg',
      color: '#000000'
    },
    {
      rel: 'shortcut icon',
      href: '/favicon/favicon.ico'
    },
  ],
}
