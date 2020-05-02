module.exports = {
  theme: {
    extend: {},
  },
  variants: {
    margin: ['responsive', 'hover', 'focus', 'active'],
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
  },
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
