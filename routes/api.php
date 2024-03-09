<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/v1/user/register', [App\Http\Controllers\User\API\AuthController::class, 'register']);
Route::post('/v1/user/login', [App\Http\Controllers\User\API\AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'user'])->group( function () {
	Route::get('/v1/movies', [App\Http\Controllers\User\API\MovieController::class, 'index']);
	Route::get('/v1/movie/{id}', [App\Http\Controllers\User\API\MovieController::class, 'getMovie']);
});


Route::post('/v1/admin/register', [App\Http\Controllers\Admin\API\AuthController::class, 'register']);
Route::post('/v1/admin/login', [App\Http\Controllers\Admin\API\AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'admin'])->group( function () {    
	Route::get('/v1/admin/movies', [App\Http\Controllers\Admin\API\MovieController::class, 'index']);
	Route::post('/v1/admin/movies', [App\Http\Controllers\Admin\API\MovieController::class, 'store']);
	Route::get('/v1/admin/movies/{id}', [App\Http\Controllers\Admin\API\MovieController::class, 'show']);
	Route::put('/v1/admin/movies/{id}', [App\Http\Controllers\Admin\API\MovieController::class, 'update']);
	
});