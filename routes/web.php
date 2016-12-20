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

Route::get('/', function () {
    return view('web');
});

Route::get('/admin', function () {
		if(Auth::check()){
			return redirect('/admin-dashboard');
		} else {
    	return view('auth.login');
    }
});

// buat logout
Route::get('logout', function() {
	Auth::logout();
	return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
