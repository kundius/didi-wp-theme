/** @type {import('postcss-load-config').Config} */
const config = {
  plugins: {
    '@csstools/postcss-global-data': {
      files: ['./src/styles/custom-media.css']
    },
    'postcss-nested': {},
    'postcss-custom-media': {}
  }
}

export default config
