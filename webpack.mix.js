const {mix} = require('laravel-mix');

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


// Copy bootstrap CSS files to public directory
mix.copy('bower_components/bootstrap/dist/css/bootstrap.css', 'public/css/libs/bootstrap.css');
mix.copy('bower_components/bootstrap/dist/js/bootstrap.js', 'public/js/libs/bootstrap.js');

// Copy bootstrap and AdminLTE CSS files to public directory
mix.copy('bower_components/AdminLTE/bootstrap/css/bootstrap.css', 'public/css/libs/bootstrap.css');
mix.copy('bower_components/AdminLTE/dist/css/AdminLTE.css', 'public/css/libs/admin-lte.css');
mix.copy('bower_components/AdminLTE/dist/css/skins/_all-skins.css', 'public/css/libs/admin-lte-skin.css');
mix.copy('bower_components/AdminLTE/dist/js/app.js', 'public/js/libs/admin-lte.js');


// Copy fonts from Glypicons
mix.copy('bower_components/AdminLTE/bootstrap/fonts', 'public/fonts');

// Font Awesome
mix.copy('bower_components/font-awesome/css/font-awesome.css', 'public/css/libs/font-awesome.css');
mix.copy('bower_components/font-awesome/fonts', 'public/fonts');

// Merge all CSS files in one file.
mix.styles([
    'public/css/libs/bootstrap.css',
    'public/css/libs/admin-lte.css',
    'public/css/libs/admin-lte-skin.css',
    'public/css/libs/font-awesome.css'
], './public/css/min.css', './public/css');


// Merge all JS  files in one file.
mix.js([
    'public/js/libs/bootstrap.js',
    'public/js/libs/admin-lte.js'
], './public/js/min.js', './public/js');


