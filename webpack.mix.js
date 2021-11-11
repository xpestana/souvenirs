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
    .copyDirectory('resources/img', 'public/vendor_asset/img')
	.copyDirectory('resources/css/custom', 'public/vendor_asset/css')
	.copyDirectory('resources/fonts', 'public/vendor_asset/fonts')
	.copyDirectory('resources/vendor_asset/js', 'public/vendor_asset/js')
	.vue()
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ])
    .styles([
        'resources/css/custom.css',
		], 'public/css/all.css')
    .webpackConfig(require('./webpack.config'));

if (mix.inProduction()) {
    mix.version();
}
