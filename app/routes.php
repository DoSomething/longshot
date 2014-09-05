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


# Pages
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
Route::get('about', ['as' => 'about', 'uses' => 'PagesController@about']);
Route::get('faq', ['as' => 'faq', 'uses' => 'PagesController@faq']);
Route::get('status', ['as' => 'status', 'uses' => 'PagesController@status'])->before('auth');


# Profile
Route::resource('profile', 'ProfilesController');


# Application
Route::resource('application', 'ApplicationController');

# Recomendation
Route::resource('recommendation', 'RecommendationController');


# Admin
Route::group(['before' => 'role:administrator', 'prefix' => 'admin'], function()
{
  Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

  Route::get('applications', ['as' => 'applications', 'uses' => 'AdminController@applications']);

  Route::resource('scholarship', 'ScholarshipController');

  Route::get('settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);
  Route::get('settings/general', ['as' => 'general.edit', 'uses' => 'SettingsController@editGeneral']);
  Route::post('settings/general', ['as' => 'general.update', 'uses' => 'SettingsController@updateGeneral']);
  Route::get('settings/appearance', ['as' => 'appearance.edit', 'uses' => 'SettingsController@editAppearance']);
  Route::post('settings/appearance', ['as' => 'appearance.update', 'uses' => 'SettingsController@updateAppearance']);
});


# Test Email
Route::get('email/send', function()
{
  Mail::send('emails.test', [], function($message)
  {
    $message->to('dlorenzo@dosomething.org')->subject('Huzzah! A Sample Mandrill email sent!');
  });

  return 'Email sent!';
});
