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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/species.edit.js', 'public/js')
    .js('resources/assets/js/page.edit.js', 'public/js')
    .sass('resources/assets/sass/app.scss','public/css')
    .styles([
        'node_modules/quill/dist/quill.snow.css',
        'public/css/app.css'
    ], 'public/css/all.css')
    .webpackConfig({
        module: {
            rules: [
                    {
                        test: /\.(handlebars|hbs)$/,
                        loader: "handlebars-loader"
                    }
                ]

        }
    });