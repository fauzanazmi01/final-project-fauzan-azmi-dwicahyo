<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderReportController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnforceLoggedIn;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
Route::resource('products', ProductController::class)->except(['create', 'edit']);

// has to be on top of orders resource
Route::middleware([
    EnforceLoggedIn::class
])->get('orders/report', [OrderReportController::class, 'index']);

Route::middleware([
    'api',
    EnforceLoggedIn::class
])->resource('orders', OrderController::class)->except(['create', 'edit']);

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
});