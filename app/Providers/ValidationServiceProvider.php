<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider {

	/**
	 * The validator instance.
	 *
	 * @var \Illuminate\Validation\Factory
	 *
	 */
	protected $validator;

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
	    
	    $this->validator = $this->app->make('validator');

	    

	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		
		//

	}

}
