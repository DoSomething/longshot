<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
*/

// Registration
Route::get('register', ['as' => 'registration.create', 'uses' => 'RegistrationController@create'])->middleware(['guest', 'isClosed']);
Route::post('register', ['as' => 'registration.store', 'uses' => 'RegistrationController@store']);
Route::put('register', ['as' => 'registration.update', 'uses' => 'RegistrationController@update']);
Route::get('register/{id}/edit', ['as' => 'registration.edit', 'uses' => 'RegistrationController@edit']);
// Authentication
Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);
// Password Reminder
Route::controller('password', 'RemindersController');
// Pages
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);
// Profile
Route::resource('profile', 'ProfilesController');
// Application
Route::resource('application', 'ApplicationController', ['middleware' => 'auth']);
// Status
Route::get('status', ['as' => 'status', 'uses' => 'StatusController@status', 'middleware' => 'auth']);
// this should be a post.
Route::get('resend-email', ['as' => 'resend', 'uses' => 'StatusController@resendEmailRequest']);
// Review
Route::get('review/{id}', ['as' => 'review', 'uses' => 'StatusController@review'])->middleware(['auth', 'isClosed']);
Route::post('review', ['as' => 'review.store', 'uses' => 'StatusController@submit', 'middleware' => 'auth']);
// Recommendation
Route::resource('recommendation', 'RecommendationController');
// Nomination
Route::post('nomination', ['as' => 'nomination.create', 'uses' => 'NominationController@store']);
// Admin
Route::group(['before' => 'role:administrator', 'prefix' => 'admin'], function () {
  Route::get('/', ['as' => 'admin', 'uses' => 'AdminController@index']);
  // Search
  Route::post('search', ['as' => 'search', 'uses' => 'AdminController@search']);
  // Applications management
  Route::get('applications', ['as' => 'applications.index', 'uses' => 'AdminController@applicationsIndex']);
  Route::get('applications/export', ['as' => 'export', 'uses' => 'AdminController@export']);
  Route::post('applications/export', ['as' => 'export.csv', 'uses' => 'AdminController@export_results']);
  Route::get('applications/{id}', ['as' => 'admin.application.show', 'uses' => 'AdminController@applicationsShow']);
  Route::get('applications/{id}/edit', ['as' => 'admin.application.edit', 'uses' => 'AdminController@applicationsEdit']);
  Route::post('application/rate', ['as' => 'applications.rate', 'uses' => 'AdminController@rate']);
  Route::post('application/complete', ['as' => 'applications.complete', 'uses' => 'AdminController@complete']);
  Route::post('resend', ['as' => 'admin.resend', 'uses' => 'AdminController@resendRecEmail']);
  // Winners
  Route::resource('winner', 'WinnerController');
  // Scholarship management
  Route::resource('scholarship', 'ScholarshipController');
  // Static Content Pages
  Route::resource('page', 'PagesController');
  // Settings
  Route::get('settings', ['as' => 'settings', 'uses' => 'AdminController@settings']);
  Route::get('settings/general', ['as' => 'general.edit', 'uses' => 'SettingsController@editGeneral']);
  Route::post('settings/general', ['as' => 'general.update', 'uses' => 'SettingsController@updateGeneral']);
  Route::get('settings/appearance', ['as' => 'appearance.edit', 'uses' => 'SettingsController@editAppearance']);
  Route::post('settings/appearance', ['as' => 'appearance.update', 'uses' => 'SettingsController@updateAppearance']);
  Route::get('settings/meta-data', ['as' => 'meta-data.edit', 'uses' => 'SettingsController@editMetaData']);
  Route::post('settings/meta-data', ['as' => 'meta-data.update', 'uses' => 'SettingsController@updateMetaData']);
  Route::post('settings/clear-cache', ['as' => 'general.clear-cache', 'uses' => 'SettingsController@clearCache']);
  // Emails
  Route::get('email', ['as' => 'emails', 'uses' => 'EmailController@index']);
  Route::post('email', ['as' => 'emails.update', 'uses' => 'EmailController@update']);
});
// Pages
// This route needs to be the last route in the list that is hit
// because the wildcard catches anything after the root and routes
// to the Pages controller for static pages.
Route::get('{page}', 'PagesController@show');
