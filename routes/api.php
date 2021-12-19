<?php

use App\Http\Controllers\Api\PostController;
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


Route::prefix('user')->group(function () {
    Route::get('/current', [\App\Http\Controllers\Api\UserController::class, 'currentUser']);
});
Route::apiResource('/posts', PostController::class)->except('index');
Route::get('/posts', [PostController::class, 'index']);


