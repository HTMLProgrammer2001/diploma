const mix = require('laravel-mix');

mix.styles([
    'resources/assets/admin/bootstrap/css/bootstrap.min.css',
    'resources/assets/admin/font-awesome/4.5.0/css/font-awesome.min.css',
    'resources/assets/admin/plugins/datepicker/datepicker3.css',
    'resources/assets/admin/plugins/select2/select2.min.css',
    'resources/assets/admin/dist/css/AdminLTE.min.css',
    'resources/assets/admin/dist/css/skin-blue.min.css'
], 'public/css/admin.css');

mix.scripts([
    'resources/assets/admin/bootstrap/js/bootstrap.min.js',
    'resources/assets/admin/plugins/select2/select2.full.min.js',
    'resources/assets/admin/plugins/datepicker/bootstrap-datepicker.js',
    'resources/assets/admin/dist/js/app.min.js',
    'resources/assets/admin/dist/js/index.js'
], 'public/js/admin.js');

mix.copy('resources/assets/admin/bootstrap/fonts', 'public/fonts');
mix.copy('resources/assets/admin/dist/fonts', 'public/fonts');

mix.copy('resources/assets/admin/dist/img', 'public/img');
