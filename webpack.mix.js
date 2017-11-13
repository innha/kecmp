/**
 * Created by edwin on 3/26/17.
 */
const { mix } = require('laravel-mix');

/*
mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/styles.scss', 'public/css');
*/
mix.autoload({
    jquery: ['$', 'window.jQuery',"jQuery","window.$","jquery","window.jquery"],
    'popper.js/dist/umd/popper.js': ['Popper']
});

mix.js(['node_modules/jquery/dist/jquery.min.js', 
		'node_modules/bootstrap/dist/js/bootstrap.min.js', 
		'resources/assets/js/app.js'], 'public/js')

.sass('resources/assets/sass/style.scss', 'public/css')
.sass('resources/assets/sass/app.scss', 'public/css')

//.sass('node_modules/bootstrap/scss/bootstrap.scss', 'public/css'); //do not use webpack to build third party scss files

.copy('node_modules/font-awesome/fonts/', 'public/fonts/');
