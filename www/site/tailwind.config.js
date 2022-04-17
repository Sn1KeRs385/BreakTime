const lineClampPlugin = require('@tailwindcss/line-clamp')

const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  mode: 'jit',
  prefix: 't-',
  content: [
    './index.html',
    './src/components/**/*.{vue,js}',
    './src/layouts/**/*.vue',
    './src/pages/**/*.vue',
    './src/plugins/**/*.{js,ts}',
    './vite.config.{js,ts}',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [lineClampPlugin],
}
