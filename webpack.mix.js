const mix = require('laravel-mix');
const Dotenv = require('dotenv-webpack');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */


 module.exports = {
    
    plugins: [
      new Dotenv({
        path: './.env',
      })
    ]
    
  };
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    
    .sourceMaps()
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    );

