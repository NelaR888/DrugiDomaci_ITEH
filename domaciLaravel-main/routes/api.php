<?php

use App\Http\Controllers\SneakersController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\BrandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('sneakers', SneakersController::class);
Route::resource('types', TypeController::class);
Route::resource('brands', BrandController::class);
Route::resource('users', UserController::class);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::get('sneakers/brand/{id}',[SneakersController::class,'getByBrand']);

Route::get('sneakers/type/{id}',[SneakersController::class,'getByType']);

Route::delete('sneakers/type/{id}',[SneakersController::class,'getByType']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::get('my-sneakers',[SneakersController::class,'mySneakers']);

    Route::get('/logout',[AuthController::class,'logout']);

    Route::resource('sneakers',SneakersController::class)->only('store','update','destroy');

});

