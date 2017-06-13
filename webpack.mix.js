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

mix.js('resources/assets/js/app.js', 'public/assets/js');

mix.scripts([
    'resources/assets/js/enum_gender_select.js',
    'resources/assets/js/enum_title_select.js'
], 'public/assets/js/enum_select.js');


mix.sass('resources/assets/sass/app.scss', '../resources/assets/css/sass.css');

mix.styles([
    'resources/assets/css/app.css',
    'resources/assets/css/sass.css'
], 'public/assets/css/all.css');
