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
	mix.less('admin.less');
	mix.sass('main.scss');

	mix.copy('resources/assets/fonts', 'public/assets/fonts');
	mix.copy('resources/assets/images', 'public/assets/images');
	mix.copy('resources/assets/bower_components/jquery/dist', 'public/dist/js');
	mix.copy('resources/assets/bower_components/chartjs', 'public/dist/js');
	mix.copy('resources/assets/bower_components/bootstrap/dist/js', 'public/dist/js');
	mix.copy('resources/assets/js/libs', 'public/dist/js');
});
