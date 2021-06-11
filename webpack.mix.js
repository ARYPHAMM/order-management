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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').disableNotifications().browserSync({
        // proxy: "http://localhost:8000",
        // host: 'http://localhost:8000',
        proxy: "http://192.168.43.2:8000/",
        host: '192.168.43.2',

        files: [
            "public/css/app.css",
            "public/js/app.js",
            "app/**/*",
            "routes/**/*",
            "resources/views/**/*",
            // "resources/lang/**/*"
        ]
    });
  