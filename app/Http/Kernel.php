<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' => \App\Http\Middleware\Authenticate::class,
		'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
		'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
		'isClosed' => \App\Http\Middleware\RedirectIfScholarshipClosed::class,
		'startedProcess' => \App\Http\Middleware\CheckIfUserHasApp::class,
		'submittedApp' => \App\Http\Middleware\CheckIfAppSubmitted::class,
		'currentUser' => \App\Http\Middleware\CheckIfCurrentUser::class,
		'createdRec' => \App\Http\Middleware\CheckIfRecRequested::class,
	];

}
