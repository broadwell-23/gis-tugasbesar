<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WebController@index');

// buat logout
Route::get('logout', function() {
	Auth::logout();
	return view('auth.login');
});

Auth::routes();

// MAPS
Route::get('/map', 'MapController@index');

// ADMIN PANEL
Route::get('/admin', 'DashboardController@index');

Route::get('/spot', 'SpotController@index');
Route::post('/spot', 'SpotController@store');
Route::put('/spot', 'SpotController@update');
Route::delete('/spot', 'SpotController@destroy');

Route::resource('team', 'TeamController');
Route::put('/team', 'TeamController@update');
Route::delete('team', 'TeamController@destroy');
