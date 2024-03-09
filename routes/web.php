<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'admin','middleware'=>['auth','admin']], function () {
	// Route::get('dashboard', 'App\Http\Controllers\Admin\DashboardController@index')->name('dashboard');
	Route::resource('movies', 'App\Http\Controllers\Admin\DashboardController');
});

Route::group(['prefix' => 'user','middleware'=>['auth','user']], function () {
	Route::get('dashboard', 'App\Http\Controllers\User\DashboardController@index')->name('dashboard');
	Route::get('/movie/{id}', 'App\Http\Controllers\User\DashboardController@getmovie');
	Route::get('/movie_notification', 'App\Http\Controllers\User\DashboardController@getNotification');
	Route::get('/movie_notification_markasread/{id}', 'App\Http\Controllers\User\DashboardController@markAsRead');

});
