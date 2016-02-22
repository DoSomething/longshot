<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function ($request) {

});

App::after(function ($request, $response) {
  //
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function () {
  if (Auth::guest()) {
      if (Request::ajax()) {
          return Response::make('Unauthorized', 401);
      } else {
          return Redirect::guest('login');
      }
  }
});

Route::filter('auth.basic', function () {
  return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function () {
  if (Auth::check()) {
      return Redirect::to('/');
  }
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function () {
  if (Session::token() != Input::get('_token')) {
      throw new Illuminate\Session\TokenMismatchException();
  }
});

/*
|--------------------------------------------------------------------------
| Custom Scholarship Application Filters
|--------------------------------------------------------------------------
|
*/
Route::filter('currentUser', function ($route) {
  if (Auth::guest()) {
      return Redirect::home();
  }
  // @TODO: protect both the applicaiton/profile edit routes!
  // if (Auth::user()->id !== (int)$route->parameter('profile')) {
  //   return Redirect::home();
  // }
});

Route::filter('role', function ($route, $request, $role) {
  if (Auth::guest() or !Auth::user()->hasRole($role)) {
      App::abort(403);
  }
});

/*
 * This filter checks to see if the scholarhsip is closed
 * If so, it blocks many many routes.
 */
Route::filter('isClosed', function ($route, $request) {
  // Is the scholarship closed?
  if (Scholarship::isClosed()) {
      // Check if the user is a guest, or if not an admin, redirect.
    if ((Auth::user() && !(Auth::user()->hasRole('administrator'))) || Auth::guest()) {
        return Redirect::home()->with('flash_message', ['text' => 'Applications have closed for the year!', 'class' => '-error']);
    }
  }
});

/*
 * This checks to see if the user has started created the process
 * Example: if the user already has an application don't create a new one, edit the current one.
 */
Route::filter('startedProcess', function ($route, $request, $value) {
  $user = Auth::user();
  if ($user && !is_null($user->$value)) {
      return Redirect::route($value.'.edit', $user->id);
  }
});

/*
 * This checks to see if the user has already created a rec
 * If so we want to edit the rec page, not create a new one.
 * This needs to remain seperate from started process to add a token.
 */
Route::filter('createdRec', function ($route, $request) {
  $user = Auth::user();
  if ($user) {
      $application = Application::where('user_id', $user->id)->first();
      $recommendations = Recommendation::where('application_id', $application->id)->get()->toArray();

      if (!empty($recommendations)) {
          return Redirect::route('recommendation.edit', ['user' => $user->id, 'app_id' => $application->id]);
      }
  }
});

/*
 * This checks to see if the user has started created the process
 * Example: if the user already has an application don't create a new one, edit the current one.
 */
Route::filter('submittedApp', function ($route, $request) {
  $user = Auth::user();
  $application = User::with('application')->whereId($user->id)->first();
  if (!is_null($user->application)) {
      $complete = Application::isSubmitted($user->id);
      if (isset($complete)) {
          return Redirect::route('status')->with('flash_message', ['text' => 'You have already submitted your application, you can no longer edit.', 'class' => '-error']);
      }
  }
});
