import React from 'react'
import Highlight, { defaultProps, Language } from 'prism-react-renderer'
import dracula from 'prism-react-renderer/themes/palenight'

type Props = {
  children: string
  className: string
}

const CodeBlock = ({ children, className }: Props) => {
  const language = className.replace(/language-/, '') as Language

  return (
    <Highlight {...defaultProps} code={children} theme={dracula} language="jsx">
      {({ className, style, tokens, getLineProps, getTokenProps }) => (
        <code className={className} style={style}>
          {tokens.map((line, i) => {
            if (
              line.length === 1 &&
              line[0].empty === true &&
              i === tokens.length - 1 // skips the ending empty line
            ) {
              return null
            }

            return (
              <div key={i} {...getLineProps({ line, key: i })}>
                {line.map((token, key) => (
                  <span key={key} {...getTokenProps({ token, key })} />
                ))}
              </div>
            )
          })}
        </code>
      )}
    </Highlight>
  )
}

export default CodeBlock
