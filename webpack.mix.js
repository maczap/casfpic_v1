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

mix.js('resources/js/app.js', 'public/js').vue(); 

mix.sass('resources/sass/app.scss', 'public/css');

    mix.js('resources/js/admin.js', 'public/js').vue()
        .postCss('resources/sass/admin.css', 'public/css', [
            require('tailwindcss'),
        ]);    
    

    mix.scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'public/js/hero/ace-responsive-menu.js',
        'resources/js/mask.js',
        'resources/js/scripts.js',
        ],'public/js/all.js');         
