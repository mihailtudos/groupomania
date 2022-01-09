<?php

use App\Http\Controllers\Api\CommentsController;
use App\Http\Controllers\Api\LikesHandler;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
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


Route::prefix('user')->group(function () {
    Route::get('/current', [\App\Http\Controllers\Api\UserController::class, 'currentUser']);
});
Route::apiResource('/posts', PostController::class);
Route::post('/profiles', ProfileController::class);
Route::get('/admin/posts', [PostController::class, 'generalPosts']);
Route::apiResource('/comments', CommentsController::class)->middleware('auth')->except('index');
Route::get('/posts/{id}/comments', [PostController::class, 'comments']);
Route::post('/{id}/likes', LikesHandler::class);
Route::post('/users/password', [UserController::class, 'updatePassword']);


