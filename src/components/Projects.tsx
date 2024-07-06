import { FC } from 'react'

const projects = [
  {
    title: 'Mealpractice: Build your practice and share it with the world!',
    url: 'https://www.mealpractice.com',
    image: 'https://cdn.mealpractice.com/logo.svg',
    body: 'Mealpractice makes it easy to cook and share the recipes you love. Discover new recipes by following practitioners with similar tastes or nutritional goals.',
  },
  {
    title: 'Astrify: Create custom stellar.toml files in seconds!',
    url: 'https://astrify.com',
    image: 'https://raw.githubusercontent.com/benbjurstrom/prezet/main/art/logo.png',
    body: "Astrify makes it easy to publish assets on the stellar network. Add your organization's information to a custom stellar.toml file. Accounts, assets, validators, and principals that are linked to the organization will show up in real time.",
  },
  {
    title: 'Prezet: Markdown Blogging for Laravel',
    url: 'https://prezet.com',
    image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/prezet.png',
    body: 'Transform your markdown files into SEO-friendly blogs, articles, and documentation!',
  },
  {
    title: 'Webconcepts Youtube Channel',
    url: 'https://www.youtube.com/c/webconcepts',
    image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/web-concepts.png',
    body: 'A youtube channel covering various concepts related to web development. My goal with this channel is to provide quick overviews and examples to bring awareness to the topic.',
  },
  {
    title: 'Personal Youtube Channel',
    url: 'https://www.youtube.com/c/benbjurstrom',
    image: 'https://s3-us-west-2.amazonaws.com/benbjurstrom.com/img/projects/benbjurstrom.png',
    body: 'A youtube channel with videos about cameras, tech, and whatever else catches my interest.',
  },
]

const Projects: FC = (): JSX.Element => {
  return (
    <>
      {projects.map((project) => (
        <a
          href={project.url}
          key={project.title}
          target="_blank"
          rel="noreferrer"
          className="hover:border-gray block px-4 py-6 hover:text-black hover:bg-gray-200 border-b border-t border-transparent"
        >
          <div className="md:flex">
            <div className="flex-shrink-0 mb-4 sm:mb-0 sm:mr-4">
              <img className="w-36 h-36 md:w-48 md:h-48" src={project.image} alt="" />
            </div>
            <div>
              <div className="mt-4 text-gray-800 font-serif text-lg font-semibold md:mt-0">{project.title}</div>
              <p className="mt-1">{project.body}</p>
            </div>
          </div>
        </a>
      ))}
    </>
  )
}

export default Projects
