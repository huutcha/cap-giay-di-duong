const mix = require('laravel-mix');

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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
mix.js('resources/js/app.js', 'public/assets/js/app.js', [
        require('sweetalert'),
        // require('admin-lte'),
        // require(''),
    ])
mix.js('resources/js/unit.js', 'public/assets/js/app.js')
mix.sass('resources/sass/app.scss', 'public/assets/css')
    .version();

mix.sass('resources/sass/unit.scss', 'public/assets/css')
mix.sass('resources/sass/user.scss', 'public/assets/css')