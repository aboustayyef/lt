<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/test', function(){

	// TO DO: CONVERT BEIRUT I, BEIRUT II and BEIRUT III to BEIRUT 1, BEIRUT 2, and BEIRUT 3 respectively

	return view('test');
});


Route::get('/ajax/{group?}/{from?}/{to?}/{parameters?}', 'AjaxController@index');

Route::get('/{group?}', 'streamController@index');

Route::get('/mps', 'MpsController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);