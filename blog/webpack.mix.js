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

mix.copy('node_modules/simplemde/dist/simplemde.min.js', 'public/js')
    .copy('node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/app.css',
    'node_modules/simplemde/dist/simplemde.min.css',
    'resources/css/blog.css',
    'node_modules/@yaireo/tagify/dist/tagify.css',
], 'public/css/all.css');

mix.js([
    'resources/js/app.js',
    'resources/js/blog.js',
], 'public/js/all.js');
