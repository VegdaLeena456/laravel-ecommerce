<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminCouponController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerProductController;
use App\Http\Controllers\CustomerProfileController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/products');
});

Route::get('/admin', function () {
    return redirect('/admin/login');
});

// --------------------------------- Admin Routes---------------------------------//

// Admin Login
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'adminLoginPage'])->name('admin.login');
    Route::post('login/store', [AdminAuthController::class, 'adminLogin'])->name('adminlogin.store');
});

// Admin Dashboard
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::post('logout', [AdminAuthController::class, 'adminLogout'])->name('admin.logout');

    // Admin Product
    Route::get('products', [AdminProductController::class, 'index'])->name('admin.products');
    Route::get('product/{id}/detail', [AdminProductController::class, 'show'])->name('admin.product.details');
    Route::get('product/create', [AdminProductController::class, 'create'])->name('admin.product.create');
    Route::post('product/store', [AdminProductController::class, 'store'])->name('admin.product.store');
    Route::put('product/{id}/update', [AdminProductController::class, 'update'])->name('admin.product.update');
    Route::get('product/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.product.edit');
    Route::delete('product/{id}/delete', [AdminProductController::class, 'delete'])->name('admin.product.delete');

    // Admin Coupon Page
    Route::get('coupon', [AdminCouponController::class, 'coupons'])->name('admin.coupons');
    Route::get('coupon/add', [AdminCouponController::class, 'add'])->name('admin.coupon.add');
    Route::post('coupon/store', [AdminCouponController::class, 'store'])->name('admin.coupon.store');
    Route::get('coupon/{id}/edit', [AdminCouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::post('coupon/{id}/update', [AdminCouponController::class, 'update'])->name('admin.coupon.update');
    Route::delete('coupon/{id}/delete', [AdminCouponController::class, 'delete'])->name('admin.coupon.delete');
});

// --------------------------------- Customer Routes ---------------------------------//

// Registration
Route::get('registration', [CustomerAuthController::class, 'registrationPage'])->name('registration');
Route::post('registration/store', [CustomerAuthController::class, 'registration'])->name('registration.store');

// Verify OTP
Route::get('verify', [CustomerAuthController::class, 'verify'])->name('verify');
Route::post('verify/otp', [CustomerAuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('verify/resendotp', [CustomerAuthController::class, 'resendOtp'])->name('resendOtp');

// Login
Route::get('login', [CustomerAuthController::class, 'loginPage'])->name('login');
Route::post('login/store', [CustomerAuthController::class, 'login'])->name('login.store');

// Customer Product Page
Route::get('products', [CustomerProductController::class, 'productList'])->name('product-list');
Route::get('products/{id}/details', [CustomerProductController::class, 'productDetails'])->name('products.details');

// Cart Page
Route::get('cart', [CartController::class, 'cart'])->name('cart');
Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('cart-remove/{id}', [CartController::class, 'delete'])->name('cart.remove');
Route::post('cart-update/{id}', [CartController::class, 'update'])->name('cart.update');

// ----------------------------- Favorite Page ---------------------------------//
Route::post('add-to-favorite/{id}', [FavoriteController::class, 'add'])->name('favorite.add');
Route::get('favorite-remove/{id}', [FavoriteController::class, 'delete'])->name('favorite.delete');

// Logged in Customer
Route::middleware('auth')->group(function () {
    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('logout');

    // ----------------------------- Profile Page ---------------------------------//
    Route::get('profile', [CustomerProfileController::class, 'index'])->name('profile');
    Route::get('profile/edit', [CustomerProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/update', [CustomerProfileController::class, 'update'])->name('profile.update');

    // ----------------------------- Checkout Page ---------------------------------//
    Route::get('checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('checkout/place-order', [CheckoutController::class, 'placeOrder'])->name('place-order');

});
