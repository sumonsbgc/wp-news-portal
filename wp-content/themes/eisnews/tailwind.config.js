/** @type {import('tailwindcss').Config} */
module.exports = {
  // content: ["./**/*.php"],
  content: [
    "./**/*.php",
    "./inc/**/*.php",
    "./templates/**/*.php",
    "./inc/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        'kalpurush': ['Kalpurush', 'sans-serif'],  
      },
      boxShadow: {
        xs: '0 0 5px 0 rgba(0,0,0, 0.1)',
        sm: '0 0 5px 0 rgba(0,0,0, 0.12)',
      },
      colors: {
        'primary': '#b51a1a',
        'red-secondary': '#ff4444',
        'carrot': '#c94900',
        'black-primary': '#222222',
        'black-light': '#343334',
        'red-50': '#fcf6eb',
        'light-white': '#f5f6f7',
        'gray-100': '#f9f9f9',
        'gray-200': '#e9e9e9',
        'gray-300': '#e6e7e8',
        'gray-400': '#d3d3d3',
        'gray-light': '#f2f2f2',
        'green': '#00a550',
        'blue': '#1b75bb',
        'blue-50': '#f1f1f2',
        'yellow': '#fbaf3f',
        'pink': '#ec008b',
        'tile': '#5e8597',
        'coal': '#363d4d',
        'olive': '#788451',
      },
      container: {
        'center': true,
        screens: {
          '2xl': '1240px'
        }
      }
    },
  },
  plugins: [],
};
