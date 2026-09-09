<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\CartController;
use App\Http\Controllers\Guest\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// ROUTE ASLI (TAPI SUDAH PAKAI CONTROLLER)
// ============================================

// Route Buat Welcome
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Route untuk Home (PAKAI CONTROLLER)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route untuk Menu (PAKAI CONTROLLER)
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

// Route untuk Location (TETAP CLOSURE)
Route::get('/location', function () {
    return view('landing.location');
})->name('location');

// Route untuk Contact (TETAP CLOSURE)
Route::get('/contact', function () {
    return view('landing.contact');
})->name('contact');

// Route untuk Cart (PAKAI CONTROLLER)
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Route Admin Page (PAKAI CONTROLLER)
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/menu', [MenuManagementController::class, 'index'])->name('admin.menu');
Route::get('/admin/order', [OrderManagementController::class, 'index'])->name('admin.order');


// ============================================
// ROUTE TAMBAHAN UNTUK CONTROLLER (BARU)
// ============================================

// Cart Routes (pakai controller)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::put('/update', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
});

// Order Routes (pakai controller)
Route::prefix('order')->name('order.')->group(function () {
    Route::post('/store', [OrderController::class, 'store'])->name('store');
    Route::get('/success/{id}', [OrderController::class, 'success'])->name('success');
    Route::get('/track', [OrderController::class, 'track'])->name('track');
    Route::get('/history', [OrderController::class, 'history'])->name('history');
});

// Admin Routes (pakai controller) - ROUTE TAMBAHAN
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/menu-controller', MenuManagementController::class)->except(['show']);
    Route::patch('/menu-controller/{id}/toggle', [MenuManagementController::class, 'toggleActive'])->name('menu.toggle.controller');
    Route::resource('/order-controller', OrderManagementController::class)->except(['create', 'edit', 'show']);
    Route::patch('/order-controller/{id}/status', [OrderManagementController::class, 'updateStatus'])->name('order.status.controller');
    Route::get('/reports/sales-controller', [OrderManagementController::class, 'salesReport'])->name('reports.sales.controller');
});