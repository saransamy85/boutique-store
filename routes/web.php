<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\ProductVariantController;



Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/shop', [HomeController::class, 'shop'])
    ->name('shop');

Route::get('/product/{slug}', [HomeController::class, 'productDetails'])
    ->name('product.details');



Route::get('/cart', [CartController::class, 'index'])
    ->name('cart.index');

Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');

Route::patch('/cart/update/{product}', [CartController::class, 'update'])
    ->name('cart.update');

Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])
    ->name('cart.remove');


Route::get('/wishlist', [WishlistController::class, 'index'])
    ->name('wishlist.index');

Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])
    ->name('wishlist.add');

Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])
    ->name('wishlist.remove');

Route::post('/wishlist/move-to-cart/{product}', [WishlistController::class, 'moveToCart'])
    ->name('wishlist.move-to-cart');


// =====================================
// LUNA BOUTIQUE - WISHLIST
// =====================================

Route::get('/wishlist', [WishlistController::class, 'index'])
    ->name('wishlist.index');

Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])
    ->name('wishlist.add');

Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])
    ->name('wishlist.remove');

Route::post('/wishlist/move-to-cart/{product}', [WishlistController::class, 'moveToCart'])
    ->name('wishlist.moveToCart');


    // Checkout Routes
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout/place-order', [CheckoutController::class, 'store'])
    ->name('checkout.store');

Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])
    ->name('checkout.success');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('products.variants',ProductVariantController::class)->except(['show'])->names('products.variants');

});
