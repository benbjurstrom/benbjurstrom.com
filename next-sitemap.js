module.exports = {
  siteUrl: 'https://benbjurstrom.com',
  changefreq: 'daily',
  sitemapSize: 5000,
  alternateRefs: [],
  generateRobotsTxt: true,
  robotsTxtOptions: {
    policies: [
      {
        userAgent: '*',
        allow: '/',
      },
    ],
  },
}
