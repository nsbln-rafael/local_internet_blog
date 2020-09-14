<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
	use App\Http\Controllers\PostController;
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

Route::get('/',             [PostController::class, 'index']);
Route::get('/show/{id}',    [PostController::class, 'show']);

Route::group(['middleware' => 'auth'], function() {
	// -- Auth --
	Route::get('/logout', [HomeController::class, 'logout']);
	// -- -- -- --

	//-- Posts --
	Route::get('/create',          [PostController::class, 'create']);
	Route::post('/store',          [PostController::class, 'store']);
	Route::get('/edit/{id}',       [PostController::class, 'edit']);
	Route::delete('/destroy/{id}', [PostController::class, 'destroy']);
	Route::match(['put', 'patch'], '/update/{id}',    [PostController::class, 'update']);
	// -- -- -- --
});

Route::group(['middleware' => 'guest'], function() {
	// -- Auth --
	Route::match(['get','post'], '/login',        [HomeController::class, 'login']);
	Route::match(['get','post'], '/registration', [HomeController::class, 'registration']);
	// -- -- -- --
});
