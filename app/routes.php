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

// Route group for API versioning
Route::group(array('prefix' => 'v1.0'), function()
{
	// Admin routes
	Route::group(array('before' => 'auth.apiKey'), function()
	{
		// Place admin routes here
		Route::match(array('PUT'), 'navigation/order', 'NavigationController@saveOrder');
		Route::resource('page', 'PageController');
		Route::resource('gallery', 'GalleryController');
		Route::resource('navigation', 'NavigationController');
		Route::resource('settings', 'SettingsController');
		Route::resource('user', 'UserController');
	});

	Route::get('page/{slug}', 'PageController@show');
	Route::get('gallery', 'GalleryController@index');
	Route::get('gallery/{slug}', 'GalleryController@show');
	Route::get('navigation', 'NavigationController@index');
	Route::get('settings', 'SettingController@index');
	Route::post('login', 'LoginController@getApiKey');
});
