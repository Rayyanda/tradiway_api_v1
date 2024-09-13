<?php

use App\Http\Controllers\Api\HerbalPlantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PlantController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HerbalDrinkController;
use App\Http\Controllers\Api\LoginController;


/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
//Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login');
/**
 * route "/user"
 * @method "GET"
 */
Route::middleware(['jwt.cookie','auth:api'])->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * route "/customer"
 * @method all
 */
Route::middleware(['jwt.cookie','auth:api'])->group(function () {

    Route::apiResource('/customer',CustomerController::class);
    
});

Route::apiResource('/plants',PlantController::class);

Route::get('/drinks',[HerbalDrinkController::class,'index']);
Route::get('/drinks/{slug}',[HerbalDrinkController::class,'show']);
Route::apiResource('/receipt', HerbalPlantController::class);
Route::get('/receipt/drinks/{drink_id}',[HerbalPlantController::class,'getByDrinks']);
Route::get('/receipt/plants/{plant_id}',[HerbalPlantController::class,'getByPlants']);

/**
 * route "/logout"
 * @method "POST"
 */
Route::middleware('jwt.cookie')->group(function(){
});
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
