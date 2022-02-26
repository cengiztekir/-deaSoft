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
    
    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/auth/logout', \App\Http\Controllers\Auth\LogoutController::class);
        
        Route::get('/users',\App\Http\Controllers\User\IndexController::class);
        Route::post('/users',\App\Http\Controllers\User\StoreController::class);
        Route::get('/users/{id}/',\App\Http\Controllers\User\ShowController::class);
        Route::put('/users/{id}',\App\Http\Controllers\User\UpdateController::class);
        Route::delete('/users/{id}/',\App\Http\Controllers\User\DeleteController::class);

        Route::get('/customers',\App\Http\Controllers\Customer\IndexController::class);
        Route::post('/customers',\App\Http\Controllers\Customer\StoreController::class);
        Route::get('/customers/{id}/',\App\Http\Controllers\Customer\ShowController::class);
        Route::put('/customers/{id}',\App\Http\Controllers\Customer\UpdateController::class);
        Route::delete('/customers/{id}/',\App\Http\Controllers\Customer\DeleteController::class);

        Route::get('/products',\App\Http\Controllers\Product\IndexController::class);
        Route::post('/products',\App\Http\Controllers\Product\StoreController::class);
        Route::get('/products/{id}/',\App\Http\Controllers\Product\ShowController::class);
        Route::put('/products/{id}',\App\Http\Controllers\Product\UpdateController::class);
        Route::delete('/products/{id}/',\App\Http\Controllers\Product\DeleteController::class);

        
    });
});
