<?php

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

Route::prefix('v1')->group(function () {

    Route::post('/auth/login', \App\Http\Controllers\Auth\LoginController::class);
    Route::get('/register', function(){
        dd(111);
    });
    

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/auth/logout', \App\Http\Controllers\Auth\LogoutController::class);
        
        Route::get('/users',\App\Http\Controllers\User\IndexController::class);
        Route::post('/users',\App\Http\Controllers\User\StoreController::class);
        Route::get('/users/{id}/',\App\Http\Controllers\User\ShowController::class);
        Route::put('/users/{id}',\App\Http\Controllers\User\UpdateController::class);
        Route::delete('/users/{id}/',\App\Http\Controllers\User\DeleteController::class);

        
    });
});
