<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/


# Registration
Route::get('register', ['as' => 'registration.create', 'uses' => 'RegistrationController@create'])->before('guest');
Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);


# Authentication
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);


# Password Reminder
Route::controller('password', 'RemindersController');


# Pages
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);


# Profile
Route::resource('profile', 'ProfilesController', ['before' => 'auth']);


# Application
Route::resource('application', 'ApplicationController', ['before' => 'auth']);

# Status
Route::get('status', ['as' => 'status', 'uses' => 'StatusController@status', 'before' => 'auth']);
# this should be a post.
Route::get('resend-email', ['as' => 'resend', 'uses' => 'StatusController@resendEmailRequest']);

# Recomendation
Route::resource('recommendation', 'RecommendationController');



# Admin
Route::group(['before' => 'role:administrator', 'prefix' => 'admin'], function()
{
  Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

  # Applications management
  Route::get('applications', ['as' => 'applications.index', 'uses' => 'AdminController@applicationsIndex']);
  Route::get('applications/{id}', ['as' => 'applications.show', 'uses' => 'AdminController@applicationsShow']);

  # Scholarship management
  Route::resource('scholarship', 'ScholarshipController');

  # Static Content Pages
  Route::resource('page', 'PageController');

  # Settings
  Route::get('settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);
  Route::get('settings/general', ['as' => 'general.edit', 'uses' => 'SettingsController@editGeneral']);
  Route::post('settings/general', ['as' => 'general.update', 'uses' => 'SettingsController@updateGeneral']);
  Route::get('settings/appearance', ['as' => 'appearance.edit', 'uses' => 'SettingsController@editAppearance']);
  Route::post('settings/appearance', ['as' => 'appearance.update', 'uses' => 'SettingsController@updateAppearance']);
});



# Pages
// This route needs to be the last route in the list that is hit
// because the wildcard catches anything after the root and routes
// to the Pages controller for static pages.
Route::get('{page}', 'PageController@staticShow');
