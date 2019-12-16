const mix = require('laravel-mix');
const path = require('path');
console.dir('path='+path.resolve(__dirname,'..'));
console.dir('path='+path.resolve(__dirname,'./'));
console.dir('path='+path.resolve(__dirname,'../'));
console.dir('path='+path.resolve(__dirname,'/'));
console.dir('path='+path.resolve(__dirname,'.'));


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

mix.js('resources/js/app.js', 'public/dist')
    .sass('resources/sass/app.scss', 'public/dist')
    .copy('resources/img/*', 'public/src/img')
    .copy('resources/fonts/*', 'public/src/fonts')
    .copy('resources/sass/pdf.css*', 'public/dist')
    .sourceMaps()

    .options({
      processCssUrls: false,
    })
    .autoload({
        jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"]
    });

    mix.version()
