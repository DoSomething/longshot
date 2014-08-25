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


# Admin
Route::group(['before' => 'role:administrator', 'prefix' => 'admin'], function()
{
  Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);

  Route::get('applications', ['as' => 'applications', 'uses' => 'AdminController@applications']);

  Route::get('customize', ['as' => 'customize', 'uses' => 'AdminController@customize']);

  Route::resource('scholarship', 'ScholarshipController');

});
