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
mix.js('resources/js/pages/asiento.js', 'public/js/pages')
mix.js('resources/js/pages/pagos.js', 'public/js/pages')
mix.js('resources/js/pages/eventos.js', 'public/js/pages');



mix.copy('node_modules/bootstrap/dist/css/bootstrap.min.css', 'public/plugins/bootstrap');
mix.copy('node_modules/swiper/**', 'public/plugins/swiper');
mix.copy('node_modules/@fancyapps/**', 'public/plugins/@fancyapps');

mix.sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/pages/lugares.scss', 'public/css/pages');
mix.sass('resources/sass/pages/pago.scss', 'public/css/pages');
mix.sass('resources/sass/pages/eventos.scss', 'public/css/pages');

mix.js('resources/js/panel/scripts/index.js', 'public/panel/js/main.js');
mix.sass('resources/sass/panel/app.scss', 'public/panel/css').version();
//Vendors del panel
mix.copy('resources/vendor/nucleo', 'public/panel/vendor/nucleo');
mix.copy('node_modules/@fortawesome/fontawesome-free', 'public/panel/vendor/@fortawesome/fontawesome-free');
//Corrige el problema con los íconos
mix.copy('node_modules/trumbowyg/dist/ui/icons.svg', 'public/panel/vendor/trumbowyg/dist/ui/icons.svg');
mix.styles(['resources/vendor/panel.css'], 'public/panel/css/main.css');

mix.version();

// mix.browserSync({
//     proxy: 'http://localhost:8000',
//     watch: true,
//     watchOptions: {
//         ignored: '/node_modules/'
//     },
//     notify: false,
//     ghostMode: false,
//     open: 'local',
// });

// mix.disableNotifications();
// mix.browserSync({
//     proxy: "http://localhost:8000",
//     files: [ //Files for watching
//         "./app/**/*",
//         "./routes/**/*",
//         "./public/css/*.css",
//         "./public/js/*.js",
//         "./resources/views/**/*.blade.php",
//         "./resources/lang/**/*",
//     ],
// });