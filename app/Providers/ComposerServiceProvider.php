<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Scholarship;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		
		view()->composer('*', Scholarship\Composers\PageComposer::class);

	}

	/**
	 * Register any application services.
	 *
	 *
	 * @return void
	 */
	public function register()
	{

		//

	}

}
