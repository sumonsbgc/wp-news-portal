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
      colors: {
        'light-white': '#f5f6f7',
        'black': '#222222',
        'green': '#00a550',
        'blue': '#1b75bb',
        'yellow': '#fbaf3f',
        'pink': '#ec008b',
        'red': '#b51a1a',
        'red-secondary': '#ff4444',
        'tile': '#5e8597',
      }
    },
  },
  plugins: [],
};
