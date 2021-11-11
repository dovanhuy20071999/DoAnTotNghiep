<?php

use App\Http\Controllers\Api\DeadlineController;
use App\Http\Controllers\Api\EssayController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/essay/create', [EssayController::class, 'createEssay']);
Route::resource('/deadline', DeadlineController::class);
Route::resource('/order', OrderController::class);
Route::resource('/user', UserController::class);
