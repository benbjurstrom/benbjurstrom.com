module.exports = {
  async redirects() {
    return [
      {
        source: '/youtube-demonitized',
        destination: '/youtube-demonetized',
        permanent: true,
      },
    ]
  },
  images: {
    domains: [
      'images.unsplash.com',
      'source.unsplash.com',
      's3-us-west-2.amazonaws.com'
    ],
  },
  webpack: (config, { isServer }) => {
    if (!isServer) {
      config.resolve.fallback.fs = false;
    }
    return config;
  },
}
