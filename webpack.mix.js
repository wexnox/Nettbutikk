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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// Se package.json for komplett liste av js. https://laravel.com/docs/5.6/mix

// Plain CSS
// mix.styles([
//     'public/css/enellerannen.cssfil'
// ], 'public/css/all.css'); // denne all.css compiler alle styles inn i en fil