<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;

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

Route::get('/', function () {
    return view('Main');
});

Route::controller(ShopController::class)->group(function(){

    Route::get('/shop', 'index')->name('shop');
    Route::get('/shop/{product}', 'show')->name('product');
    
});

Route::controller(CartController::class)->group(function(){
    Route::get('/cart', 'index')->name('cart');
    Route::post('/cart', 'store')->name('cart.store');
    Route::delete('/cart/{product}', 'destroy')->name('cart.destroy');
});

