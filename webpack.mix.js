const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js');

mix.js('resources/assets/js/admin_custom_2.js', 'public/js');

mix.js('resources/assets/js/metis.js', 'public/js');

mix.sass('resources/assets/sass/app.scss', '../resources/assets/css/sass.css');

mix.combine([
    'resources/assets/css/app.css',
    'resources/assets/css/metismenu.css',
    'resources/assets/css/admin_custom_2.css',
    'resources/assets/css/sass.css'
], 'public/css/all.css');
