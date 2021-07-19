module.exports = {
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
