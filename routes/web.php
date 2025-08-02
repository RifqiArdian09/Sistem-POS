<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\ReportController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Customer Routes (tanpa auth)
Route::prefix('order')->group(function () {
    Route::get('/', [CustomerOrderController::class, 'index'])->name('customer.order');
    Route::post('/', [CustomerOrderController::class, 'store']);
    Route::get('/success', [CustomerOrderController::class, 'success'])->name('customer.order.success');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Products
    Route::resource('products', ProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class)->except(['show']);

    // Orders
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/show', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');



    Route::get('/orders/pending', [OrderController::class, 'pendingOrders'])->name('orders.pending.index');
    Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('orders/{order}/receipt', [OrderController::class, 'printReceipt'])->name('orders.receipt');

    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::post('/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::post('/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');
        Route::post('/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    });
});