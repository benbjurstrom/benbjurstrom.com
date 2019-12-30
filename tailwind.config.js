module.exports = {
  theme: {
    // https://github.com/benface/tailwindcss-transforms
    scale: { // defaults to {}
      '75': '0.75',
      '100': '1'
    },
    // https://github.com/benface/tailwindcss-transitions
    transitionDuration: {
      'default': '50ms',
      '0': '0ms',
      '25': '25ms',
      '50': '50ms',
      '100': '100ms'
    },
    extend: {
      colors: {
        youtube: '#FF0000',
      },
      maxHeight: {
        '1/4': '25%',
        '1/2': '50%',
        '3/4': '75%',
        'full': '100%'
      },
      fontFamily: {
        sans: [
          'Montserrat',
          'Ubuntu',
          '-apple-system',
          'BlinkMacSystemFont',
          '"Segoe UI"',
          'Roboto',
          '"Helvetica Neue"',
          'Arial',
          '"Noto Sans"',
          'sans-serif',
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"'
        ]
      },
      spacing: {
        '1/2': '50%',
        '1/3': '33.333333%',
        '2/3': '66.666667%',
        '1/4': '25%',
        '2/4': '50%',
        '3/4': '75%',
        '1/5': '20%',
        '2/5': '40%',
        '3/5': '60%',
        '4/5': '80%',
        '1/6': '16.666667%',
        '2/6': '33.333333%',
        '3/6': '50%',
        '4/6': '66.666667%',
        '5/6': '83.333333%',
        '1/12': '8.333333%',
        '2/12': '16.666667%',
        '3/12': '25%',
        '4/12': '33.333333%',
        '5/12': '41.666667%',
        '6/12': '50%',
        '7/12': '58.333333%',
        '8/12': '66.666667%',
        '9/12': '75%',
        '10/12': '83.333333%',
        '11/12': '91.666667%',
        '72': '18rem',
        '80': '20rem',
        '96': '24rem',
        '128': '32rem'
      },
      zIndex: {
        '100': '100'
      }
    }
  },
  variants: {},
  plugins: [
    require('tailwindcss-transitions')(),
    require('tailwindcss-transforms')()
  ]
}
