<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use Inertia\Inertia;

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
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/transactions', function () {
    return Inertia::render('Transactions');
})->middleware(['auth', 'verified'])->name('transactions');

Route::post('/transactions/add', [TransactionController::class, 'store'])->middleware(['auth', 'verified'])->name('transactions/add');

Route::get('/transactions/list', [TransactionController::class, 'index'])->middleware(['auth', 'verified'])->name('transactions/list');

Route::get('/transactions/lineChart', [TransactionController::class, 'lineChart'])->middleware(['auth', 'verified'])->name('transactions/lineChart');

Route::get('/categories', function () {
    return Inertia::render('Categories');
})->middleware(['auth', 'verified'])->name('categories');
Route::get('/categories/category', function () {
    return Inertia::render('Category');
})->middleware(['auth', 'verified'])->name('category');

Route::post('/categories/add', [CategoryController::class, 'store'])->middleware(['auth', 'verified'])->name('categories/add');
Route::post('/categories/edit', [CategoryController::class, 'edit'])->middleware(['auth', 'verified'])->name('categories/edit');
Route::post('/categories/destroy', [CategoryController::class, 'destroy'])->middleware(['auth', 'verified'])->name('categories/destroy');

Route::get('/categories/list', [CategoryController::class, 'index'])->middleware(['auth', 'verified'])->name('categories/list');
Route::get('/users/balance', [RegisteredUserController::class, 'getBalance'])->middleware(['auth', 'verified'])->name('/users/balance');

Route::get('/analytics', function () {
    return Inertia::render('Analytics');
})->middleware(['auth', 'verified'])->name('analytics');

Route::get('/settings', function () {
    return Inertia::render('Settings');
})->middleware(['auth', 'verified'])->name('settings');

require __DIR__.'/auth.php';
