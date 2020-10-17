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

mix
.sass('node_modules/bootstrap/scss/bootstrap.scss','public/site/bootstrap.css')
.scripts('node_modules/jquery/dist/jquery.js','public/site/jquery.js')
.scripts('node_modules/bootstrap/dist/js/bootstrap.bundle.js','public/site/bootstrap.js')
.styles('node_modules/datatables/media/css/jquery.dataTables.min.css','public/site/datatables.css')
.scripts('node_modules/datatables/media/js/jquery.dataTables.min.js','public/site/datatables.js')
.styles('node_modules/jquery-confirm/dist/jquery-confirm.min.css','public/site/jquery-confirm.css')
.scripts('node_modules/jquery-confirm/dist/jquery-confirm.min.js','public/site/jquery-confirm.js');