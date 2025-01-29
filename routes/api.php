<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [ServiceController::class, 'index']);  // Get all services

Route::group(['middleware'=>['auth:sanctum']],function(){

    Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
        Route::get('/', [ServiceController::class, 'index']);  // Get all services
        Route::post('/', [ServiceController::class, 'store']); // Create a new service
        Route::get('/{service}', [ServiceController::class, 'show']); // Get a single service
        Route::put('/{service}', [ServiceController::class, 'update']); // Update a service
        Route::delete('/{service}', [ServiceController::class, 'destroy']); // Delete a service
    });


    Route::group(['prefix' => 'category'], function () {

        Route::post('/', [ServiceController::class, 'store']); // Create a new service
        Route::get('/{category}', [ServiceController::class, 'show']); // Get a single service
        Route::put('/{category}/edit', [ServiceController::class, 'update']); // Update a service
        Route::delete('/{category}/delete', [ServiceController::class, 'destroy']); // Delete a service
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/{id}', [UserController::class, 'getProfile']);// Get user profile
        Route::post('/{id}/edit', [UserController::class, 'update']);// Update user profile
        Route::delete('/{id}/delete', [UserController::class, 'destroy']);// Delete user profile
    });


});

require __DIR__.'/auth.php';
