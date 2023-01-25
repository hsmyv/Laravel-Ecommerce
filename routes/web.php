<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SaveForLaterController;
use App\Models\Product;

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

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'index')->name('index');
});

Route::controller(ShopController::class)->group(function(){

    Route::get('/shop', 'index')->name('shop');
    Route::get('/shop/{product}', 'show')->name('product');

});

Route::controller(CartController::class)->group(function(){
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart', 'store')->name('cart.store');
    Route::delete('/cart/{product}', 'destroy')->name('cart.destroy');
    Route::post('/cart/switchToSaveForLater/{product}', 'switchToSaveForLater')->name('cart.switchToSaveForLater');
    Route::patch('cart/{product}', 'update')->name('cart.update');

});


Route::controller(SaveForLaterController::class)->group(function(){
    Route::delete('/cart/SaveForLater/{product}', 'destroy')->name('cart.saveForLater.destroy');
    Route::post('/cart/SaveForLater/switchToSaveForLater/{product}', 'switchToSaveForLater')->name('cart.SaveForLater.switchToCart');
});


Route::controller(CheckoutController::class)->group(function(){
    Route::get('/checkout', 'index')->name('checkout.index');
    Route::post('/checkout', 'store')->name('checkout.store');
});

Route::controller(CouponsController::class)->group(function(){
    Route::post('user', 'store')->name('coupon.store');
    Route::delete('user', 'destroy')->name('coupon.destroy');
});
