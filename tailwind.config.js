/**
 * @type {import('tailwindcss').Config}
 */
export default {
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/js/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#0066cc',
        secondary: '#666666',
      },
    },
  },
  plugins: [],
}
