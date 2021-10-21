module.exports = {
  purge: {
    enabled: true,
    content: ['./resources/**/*.blade.php',],
      options: {
        safelist: [
          /data-theme$/,
        ]
      },
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      minWidth : {
        '700' : '700px'
      },
      minHeight : {
        '500' : '500px'
      },
      display: ['hover', 'focus'],
      gridTemplateColumns: {
          'custom-chart' : 'max-content max-content auto'
      },
      gridTemplateRows: {
          'custom-chart' : 'max-content'
      }
    },
  },
  variants: {
    extend: {},
  },

  plugins: [
    require('daisyui'),
  ],
}
