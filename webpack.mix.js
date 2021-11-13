const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
  
mix.js(['resources/apps/app.js',
   'resources/apps/assets/js/adminlte.min.js',
   'resources/apps/assets/js/demo.js'], 'public/js/apps').sourceMaps()
   .sass('resources/apps/assets/style.scss', 'public/css/apps');      
