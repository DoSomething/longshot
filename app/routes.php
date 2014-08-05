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
  return View::make('pages.home');
});


Route::get('about', function()
{
  return View::make('pages.about');
});


Route::get('faq', function()
{
  return View::make('pages.faq');
});


Route::get('application', function()
{
  return View::make('pages.application');
});


Route::get('recommendation', function()
{
  return View::make('pages.recommendation');
});


Route::get('status', function()
{
  return View::make('pages.status');
});


Route::get('admin', function()
{
  return View::make('pages.admin');  // @TODO: Likely need to move this out of pages directory and into dedicated admin one.
});