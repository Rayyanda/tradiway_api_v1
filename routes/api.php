<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\HerbalDrinkController;


/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/customer"
 * @method all
 */
Route::middleware('auth:api')->group(function () {

    Route::apiResource('/customer',CustomerController::class);
    
});

Route::apiResource('/plant',PlantController::class);

Route::get('/drinks',[HerbalDrinkController::class,'index']);
Route::get('/drinks/{id}',[HerbalDrinkController::class,'show']);

/**
 * route "/logout"
 * @method "POST"
 */
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
