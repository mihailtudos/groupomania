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

Auth::routes();

Route::middleware('auth:sanctum')->group(function () {
    // fallback route (all routs that don't have api in it will be handled by Vue)
    Route::get('/{any?}', function () {
        return view('welcome');
    })->where('any', '^(?!api\/)[\/\w\.\,-]*');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

