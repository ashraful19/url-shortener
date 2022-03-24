const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js');

mix.vue();

mix.sass('resources/css/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })

mix.copy('resources/images', 'public/images');

mix.version();

mix.webpackConfig({
    output: {
        chunkFilename: "js/chunks/[chunkhash].js",
        clean: {
            keep: /^(?!.*js\/chunks.*$).*/
        }
    },
});
