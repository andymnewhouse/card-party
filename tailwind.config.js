module.exports = {
  purge: [
    './resources/views/**/*.html',
    './resources/views/**/*.blade.php'
  ],
  theme: {
    extend: {
      colors: {
        eggshell: {
          100: '#FEFDED',
          200: '#FAF7E6',
          300: '#F4F1DE',
          400: '#DDD9C8',
          500: '#C4C1B2',
          600: '#ACA99B',
          700: '#949185',
          800: '#7D796F',
          900: '#656159',
        },
        'blue-gray': {
          100: '#E7EAEF',
          200: '#D4D7DE',
          300: '#AEB1BD',
          400: '#898C9D',
          500: '#63667C',
          600: '#50536C',
          700: '#3D405B',
          800: '#31334F',
          900: '#252642',
        },
        red: {
          100: '#F9BAB6',
          200: '#F7A4A2',
          300: '#F58E8C',
          400: '#F37676',
          500: '#F16061',
          600: '#CE4D4E',
          700: '#AB3B3B',
          800: '#892628',
          900: '#661414',
        },
        green: {
          100: '#C9E7DB',
          200: '#B5DFCE',
          300: '#A3D0BC',
          400: '#93C1AB',
          500: '#81B29A',
          600: '#67917B',
          700: '#4E715D',
          800: '#35503E',
          900: '#1B301F',
        }
      }
    },
  },
  variants: {
    margin: ['responsive', 'hover', 'focus', 'active'],
    opacity: ['responsive', 'hover', 'focus', 'disabled'],
  },
  plugins: [
    require('@tailwindcss/ui'),
  ],
}
