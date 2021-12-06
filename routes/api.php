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

//public routes
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::prefix('user')->group(function () {
        Route::get('/current', [\App\Http\Controllers\Api\UserController::class, 'currentUser']);
    });
    Route::apiResource('/posts', PostController::class)->except('index');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/posts', [PostController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
