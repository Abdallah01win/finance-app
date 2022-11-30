<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
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

/** Transactions Routes */
Route::controller(TransactionController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/transactions', function (){
        return Inertia::render('Transactions');
    })->name('transactions');
    Route::get('/transactions/list', 'index')->name('transactions/list');
    Route::post('/transactions/add', 'store')->name('transactions/add');
    Route::get('/transactions/lineChart', 'lineChart')->name('transactions/lineChart');
});

/** Categories Routes */
Route::controller(CategoryController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/categories', function (){
        return Inertia::render('Categories');
    })->name('categories')->name('categories');
    Route::get('/categories/category', function (){
        return Inertia::render('Category');
    })->name('Category')->name('category');

    Route::get('/categories/list', 'index')->name('categories/list');
    Route::post('/categories/add', 'store')->name('categories/add');
    Route::post('/categories/edit', 'edit')->name('categories/edit');
    Route::post('/categories/destroy', 'destroy')->name('categories/destroy');
});

/** Settings Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function (){
    Route::get('settings', function (){
    return Inertia::render('Settings');
    })->name('settings');
    Route::post('/settings/edit', 'update')->name('settings/edit');
});

/** Analytics Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function (){
    Route::get('analytics', function (){
    return Inertia::render('Analytics');
    })->name('analytics');
});

/** User Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function (){
    Route::get('/users/balance', 'getBalance')->name('/users/balance');
    Route::get('/users', 'getUser')->name('/users');
    Route::get('/user/avatar', 'getAvatar')->name('user/avatar');
});

require __DIR__.'/auth.php';