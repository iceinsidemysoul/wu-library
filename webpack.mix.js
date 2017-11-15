let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js/app.js')
   .js('resources/assets/js/admin.js', 'public/js/admin.js');
   // .js('resources/assets/js/sb-admin.js', 'public/js/sb-admin.js')
   // .js('resources/assets/js/jquery.easing.js', 'public/js/jquery.easing.js');

mix.sass('resources/assets/sass/app.scss', 'public/css/app.css')
   .sass('resources/assets/sass/admin.scss', 'public/css/admin.css')
   .sass('resources/assets/sass/wu.scss', 'public/css/wu.css');
