<?php

declare(strict_types=1);

use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

// -- Auth --
Route::match(['get','post'], '/login',        [HomeController::class, 'login']);
Route::match(['get','post'], '/registration', [HomeController::class, 'registration']);
Route::match(['get'],        '/logout',       [HomeController::class, 'logout']);
// -- -- -- --
