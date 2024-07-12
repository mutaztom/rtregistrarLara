/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors')
module.exports = {
    content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    './pages/**/*.{html,js}',
    './components/**/*.{html,js}',
    './public/index.php',
      "./node_modules/flowbite/**/*.js"
    ],
    presets: [
        require('@acmecorp/tailwind-base')
      ],
    theme: {
          fontFamily: {
            sans: ['Graphik', 'sans-serif'],
          },
          screens: {
            sm: '480px',
            md: '768px',
            lg: '976px',
            xl: '1440px',
          },
          container: {
            center: true,
          },
          colors:{
            primary: colors.blue,
            secondary: colors.slate,
            dark: colors.gray,
            green: colors.emerald,
          },
    extend: {
      colors: {
        transparent: 'transparent',
        current: 'currentColor',
        black: colors.black,
        white: colors.white,
        gray: colors.gray,
        emerald: colors.emerald,
        indigo: colors.indigo,
        yellow: colors.yellow,
        pink: colors.pink,
        rose: colors.rose,
        fuchsia: colors.fuchsia,
        blue: colors.blue,
        blue_300: colors.blue-300,
      },
    },
    },
    plugins: [
      require('@tailwindcss/forms'),
      require('flowbite/plugin')({
        charts: true,
        forms: true,
        tooltips: true
    }),
      require('@tailwindcss/typography'),
    ],
    }