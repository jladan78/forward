let mix = require('laravel-mix');

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

mix.styles([
    //'node_modules/font-awesome/css/font-awesome.min.css',
    'resources/assets/plantilla/css/font-awesome.min.css',
    'node_modules/@coreui/icons/css/coreui-icons.min.css',
    'node_modules/simple-line-icons/css/simple-line-icons.min.css',
    //'resources/assets/plantilla/css/simple-line-icons.css',
    'resources/assets/plantilla/css/pace.min.css',
    'resources/assets/plantilla/css/style.css',
    'resources/assets/plantilla/css/style_jl.css'
], 'public/css/plantilla.css')
.scripts([
    'node_modules/jquery/dist/jquery.min.js',
    'node_modules/popper.js/dist/umd/popper.min.js',
    'node_modules/bootstrap/dist/js/bootstrap.min.js',
    'node_modules/chart.js/dist/Chart.min.js',
    'node_modules/pace-progress/pace.min.js',
    'node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js',
   // 'resources/assets/plantilla/js/template.js',
    'node_modules/@coreui/coreui/dist/js/coreui.min.js',
    'resources/assets/plantilla/js/sweetalert2.all.js'
], 'public/js/plantilla.js')
.js(['resources/assets/js/app.js'],'public/js/app.js');