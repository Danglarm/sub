module.exports = {
    content: [
      './node_modules/flyonui/dist/js/*.js',
      './resources/**/*.blade.php',
      './resources/**/*.js',
    ],
    plugins: [
      require("flyonui"),
      require("flyonui/plugin") // Require only if you want to use FlyonUI JS component
    ],
    theme: {
      extend: {},
    },
    plugins: [],
  }