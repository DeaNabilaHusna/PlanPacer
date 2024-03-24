/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        raleway : ['Raleway'],
        paytone : ['Paytone One']
    },
    colors: {
      'yellow': '#FFA33C',
      'navy': '#11235A',
      'defwhite': '#FCFEFE',
      'dafblack': '#121212',
    }
    },
  },
  plugins: [],
}

