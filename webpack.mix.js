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

mix.js('resources/assets/js/species.edit.js', 'public/js')
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