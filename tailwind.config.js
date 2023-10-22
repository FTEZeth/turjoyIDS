/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],

  module:{
    theme:{
        colors:{
            'green': '#2ecc71',
            'blue':'#0a74da',
            'lightGray':'#f4f4f4',
            'darkGray':'#333333',
            'red':'#ff6b6b',
            'gray':'#eaeaea',
        },
    },
  },
}

