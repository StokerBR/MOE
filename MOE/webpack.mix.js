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

mix.scripts(['resources/assets/js/**/*.js'], 'public/assets/js/app.js').version();

mix.sass('resources/assets/scss/app.scss', 'public/assets/css/app.css').options({
    processCssUrls: false
}).version();

let vendorJsFiles = [
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'
];

let vendorCssFiles = [
    'node_modules/bootstrap/dist/css/bootstrap.min.css'
];

mix.scripts(vendorJsFiles, 'public/assets/js/vendor.js').version();
mix.styles(vendorCssFiles, 'public/assets/css/vendor.css').version();

// mix.copyDirectory('resources/assets/fonts', 'public/assets/fonts');
// mix.copyDirectory('resources/assets/webfonts', 'public/assets/webfonts');
