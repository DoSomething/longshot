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

Route::get('/', function()
{
	return View::make('hello');
});


/**
 * Setting up some initial routes.
 */
Route::get('about', function()
{
	return 'This is the About page';
});


Route::get('faq', function()
{
	return 'This is the FAQs page';
});


Route::get('application', function()
{
	return 'This is the Application page';
});


Route::get('recommendation', function()
{
	return 'This is the Recommendations page';
});


Route::get('status', function()
{
	return 'This is the Status page';
});


Route::get('admin', function()
{
	return 'This is the Admin page';
});