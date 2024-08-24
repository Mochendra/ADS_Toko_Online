<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Authentication Routes (Accessible to everyone)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Middleware group to require authentication for all routes
Route::middleware(['auth'])->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Checkout Route
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

    // Admin Routes (Require admin access)
    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
        Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });

    // Cart Routes
    Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang'); 
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add'); 
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update'); 
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove'); 

    // Product Resource Routes
    Route::resource('products', ProductController::class);

    // Order Routes
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Checkout Process
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout.process');
});
