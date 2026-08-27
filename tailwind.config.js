/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        charcoal: '#1a1a1a',
        maroon: '#7F0017',
        paper: '#f5f0e8',
        gold: '#d4a843',
        teal: '#2a9d8f',
        ink: '#2c2c2c',
      },
    },
  },
  plugins: [],
}
