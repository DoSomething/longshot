var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix.less('bootstrap.less');

	mix.sass('main.scss');
	mix.sass('admin.scss');

	mix.copy('resources/assets/fonts', 'public/dist/fonts');
	mix.copy('resources/assets/images', 'public/dist/images');
	mix.copy('resources/assets/bower_components/jquery/dist', 'public/dist/js');
	mix.copy('resources/assets/bower_components/chartjs', 'public/dist/js');
	mix.copy('resources/assets/bower_components/bootstrap/dist/js', 'public/dist/js');
	mix.copy('resources/assets/bower_components/bootstrap/dist/css', 'public/dist/css');
	mix.copy('resources/assets/js/libs', 'public/dist/js');
	mix.browserify('main.js', 'public/dist/js/main.js');
});
