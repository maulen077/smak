<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\BasketController;
use App\Http\Controllers\Api\LanguageController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/lang/{locale}', [LanguageController::class, 'switchLanguage'])->name('lang.switch');

Route::group(['prefix' => 'menu'], function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu');
});

Route::group(['prefix' => 'index'], function () {
    Route::get('/', [MainController::class, 'index'])->name('index');
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', [MainController::class, 'contact'])->name('contact');
});

Route::group(['prefix' => 'basket'], function () {
    Route::post('/add/', [BasketController::class, 'addToBasket'])->name('add_basket');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('/', [\App\Http\Controllers\Api\OrderController::class, 'index'])->name('order');
    Route::post('/store/', [\App\Http\Controllers\Api\OrderController::class, 'store'])->name('order_store');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
    Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
    Route::get('main', [\App\Http\Controllers\Admin\AuthController::class, 'main'])->name('main');


    Route::group(['prefix'=> 'category'], function () {
        Route::get('', [CategoryController::class, 'index'])->name('categories');
        Route::get('category-create', [CategoryController::class, 'create'])->name('category_create');
        Route::post('category-store', [CategoryController::class, 'store'])->name('category_store');
        Route::get('category-edit/{category}', [CategoryController::class, 'edit'])->name('category_edit');
        Route::put('category-update/{category}', [CategoryController::class, 'update'])->name('category_update');
        Route::delete('category-delete/{category}', [CategoryController::class, 'delete'])->name('category_delete');
    });

    Route::group(['prefix'=> 'dish'], function () {
        Route::get('', [DishController::class, 'index'])->name('dishes');
        Route::get('dish-create', [DishController::class, 'create'])->name('dish_create');
        Route::post('dish-store', [DishController::class, 'store'])->name('dish_store');
        Route::get('dish-edit/{dish}', [DishController::class, 'edit'])->name('dish_edit');
        Route::put('dish-update/{dish}', [DishController::class, 'update'])->name('dish_update');
        Route::delete('dish-delete/{dish}', [DishController::class, 'delete'])->name('dish_delete');
        Route::post('/dish/{id}/recommend', [DishController::class, 'recommend'])->name('dish_recommend');
    });

    Route::group(['prefix'=> 'order'], function () {
        Route::get('', [OrderController::class, 'index'])->name('orders');
    });

    Route::group(['prefix'=> 'banner'], function () {
        Route::get('', [BannerController::class, 'index'])->name('banners');
        Route::get('banner-create', [BannerController::class, 'create'])->name('banner_create');
        Route::post('banner-store', [BannerController::class, 'store'])->name('banner_store');
        Route::delete('banner-delete/{dish}', [BannerController::class, 'delete'])->name('banner_delete');
    });

    Route::group(['prefix'=> 'contact'], function () {
        Route::get('', [ContactController::class, 'index'])->name('contacts');
        Route::get('contact-create', [ContactController::class, 'create'])->name('contact_create');
        Route::post('contact-store', [ContactController::class, 'store'])->name('contact_store');
        Route::get('contact-edit/{contact}', [ContactController::class, 'edit'])->name('contact_edit');
        Route::put('contact-update/{contact}', [ContactController::class, 'update'])->name('contact_update');
        Route::delete('contact-delete/{contact}', [ContactController::class, 'delete'])->name('contact_delete');
    });

});



