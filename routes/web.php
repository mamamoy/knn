<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/stock', StockController::class);
Route::resource('/items', ItemsController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard-store', [DashboardController::class, 'store'])->name('dashboard.store');
Route::get('/dashboard-result', [DashboardController::class, 'result'])->name('dashboard.result');
// Route::resource('/order', OrdersController::class);
Route::post('/stock/tambah-data', [StockController::class, 'tambahData'])->name('stock.tambah-data');
Route::get('/order-confirm', [OrdersController::class, 'confirm'])->name('order.confirm');
Route::get('/order', [OrdersController::class, 'index'])->name('order.index');
Route::get('/order-history', [OrdersController::class, 'history'])->name('order.history');
Route::get('/order/{id}', [OrdersController::class, 'show'])->name('order.show');
Route::post('/order/create', [OrdersController::class, 'create'])->name('order.create');
Route::post('/order/store', [OrdersController::class, 'store'])->name('order.store');
