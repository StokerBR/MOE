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

// mix.browserSync('http://localhost:8000/');
mix.disableNotifications();

mix.scripts(['resources/assets/js/**/*.js'], 'public/assets/js/app.js');

mix.sass('resources/assets/scss/app.scss', 'public/assets/css/app.css').options({
    processCssUrls: false
}).version();

let vendorJsFiles = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
    'node_modules/parsleyjs/dist/parsley.min.js',
	'node_modules/parsleyjs/dist/i18n/pt-br.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/select2/dist/js/i18n/pt-BR.js',
];

let vendorCssFiles = [
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/select2/dist/css/select2.min.css',
    'resources/assets/vendors/mdi/css/materialdesignicons.min.css',
];

mix.scripts(vendorJsFiles, 'public/assets/js/vendor.js');
mix.styles(vendorCssFiles, 'public/assets/css/vendor.css');

mix.options({
    watchOptions: {
        ignored: /node_modules/
    }
})

if (mix.inProduction()) {
    mix.version();
    mix.copyDirectory('resources/assets/img', 'public/assets/img');
    mix.copyDirectory('resources/assets/fonts', 'public/assets/fonts');
}
