<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


// Sessions Routes
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);


// Home Route
Route::get('/', ['as' => 'home', function()
{
  return View::make('pages.home');
}]);


// Admin Route
Route::get('admin', function()
{
  return View::make('pages.admin', ['user' => Auth::user()]);
})->before('auth');




//Temporary Seeding New User
Route::get('/seed', function()
{

  $user = new User;

  $user->email = 'bs@dosomething.org';
  $user->password = Hash::make('1234');
  $user->role = 'admin';
  $user->first_name = 'Braumhilda';
  $user->last_name = 'Snosages';
  $user->birthdate = '1998-10-05';
  $user->phone = '555-555-5555';
  $user->address_street = '321 Lederhosen Lane';
  $user->address_premise = 'APT 8B';
  $user->city = 'Steinway';
  $user->state = 'NY';
  $user->zip = 12345;
  $user->gender = 'female';
  $user->race = 'caucasian';
  $user->school = 'Steinway High School';
  $user->grade = 11;

  $user->save();

  return 'New user added!';

});
