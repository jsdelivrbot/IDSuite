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
mix.js('resources/assets/js/progressbar.js', 'public/assets/js');
mix.js('resources/assets/js/chart_placeholder.js', 'public/assets/js');
mix.js('resources/assets/js/custom_tabs.js', 'public/assets/js');
mix.js('resources/assets/js/account_charts.js', 'public/assets/js');
mix.js('resources/assets/js/device_status.js', 'public/assets/js');
mix.js('resources/assets/js/account_note.js', 'public/assets/js');
mix.js('resources/assets/js/records.js', 'public/assets/js');
mix.js('resources/assets/js/device_charts.js', 'public/assets/js');

mix.copy('resources/assets/js/amcharts', 'public/assets/js/amcharts');
mix.copy('node_modules/jquery-validation/dist/jquery.validate.js', 'public/assets/js');
mix.copy('node_modules/jquery-validation/dist/additional-methods.js', 'public/assets/js');

mix.copy('resources/assets/img', 'public/img');

mix.copy('node_modules/font-awesome/css/font-awesome.css', 'public/assets/css/font-awesome.css');
mix.copy('node_modules/font-awesome/fonts', 'public/assets/fonts');
mix.scripts([
    'resources/assets/js/enum_gender_select.js',
    'resources/assets/js/enum_title_select.js'
], 'public/assets/js/enum_select.js');

// chart stuff

mix.scripts([
    'resources/assets/js/chart/util.js',
    'resources/assets/js/chart/api.js',
    'resources/assets/js/chart/yarinit.js',
], 'public/assets/js/chart_custom.js');


// mix.sass('resources/assets/sass/app.scss', '../resources/assets/css/sass.css');

mix.styles([
    'resources/assets/css/app.css',
    'resources/assets/css/sidebar.css',
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/sass.css'
], 'public/assets/css/all.css');

mix.styles([
    'resources/assets/css/custom_tabs.css'
], 'public/assets/css/custom_tabs.css');



