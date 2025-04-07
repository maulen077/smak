<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\MainController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    //Route::get('/', [MainController::class, 'index'])->name('index');
    Route::post('/register', [MainController::class, 'register'])->name('register');
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group(['prefix' => 'menu'], function () {
//    Route::get('/', [MenuController::class, 'index'])->name('menu');
//});
//
//Route::group(['prefix' => 'basket'], function () {
//    Route::post('/add/', [BasketController::class, 'addToBasket'])->name('add_basket');
//});
//
//Route::group(['prefix' => 'order'], function () {
//    Route::get('/', [OrderController::class, 'index'])->name('order');
//    Route::post('/store/', [OrderController::class, 'store'])->name('order_store');
//});
