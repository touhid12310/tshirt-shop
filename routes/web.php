<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;

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

// Ecommerce
Route::get('/', [ShopController::class, 'index']);
Route::get('/category/{category}', [ShopController::class, 'category']);
Route::get('/details/{product}', [ShopController::class, 'details']);
Route::get('/order/cart', [OrderController::class, 'cart'])->name('cart-page');
Route::get('/order/checkout', [OrderController::class, 'checkout'])->name('checkout-page');
Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order-confirmation');


Route::get('tags', [ShopController::class, 'tags'])->name('tags');
