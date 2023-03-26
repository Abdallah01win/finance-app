<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
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

    $transactionsByType = Category::with('transactions')
        ->get()
        ->groupBy('type')
        ->map(function ($categories) {
            return $categories->flatMap(function ($category) {
                return $category->transactions;
            })
                ->sum('ammount');
        });

    // Retrieve the sum of all limits grouped by category type
    $categoryLimits = Category::groupBy('type')
        ->selectRaw('type, sum(`limit`) as limit_sum')
        ->pluck('limit_sum', 'type');

    // Combine the transaction sums and category limits into an array of objects
    $result = collect($transactionsByType)
        ->map(function ($sum, $type) use ($categoryLimits) {
            return [
                'type' => $type,
                'transactions_sum' => $sum,
                'limit' => $categoryLimits[$type],
            ];
        })
        ->values()
        ->all();
    return Inertia::render('Dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => $result,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

/** Transactions Routes */
Route::middleware(['auth', 'verified'])->prefix('transactions')->name('transactions.')->group(function () {
    Route::get('/', [TransactionController::class, 'index']);
    Route::post('store', [TransactionController::class, 'store'])->name('store');
    Route::get('list', [TransactionController::class, 'list'])->name('list');
    Route::get('lineChart', [TransactionController::class, 'lineChart'])->name('lineChart');
});

/** Categories Routes */
Route::middleware(['auth', 'verified'])->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::post('category', [CategoryController::class, 'show'])->name('category.show');
    Route::get('list', [CategoryController::class, 'index'])->name('categories.list');
    Route::post('add', [CategoryController::class, 'store'])->name('categories.add');
    Route::post('edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

/** Settings Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('settings', function () {
        return Inertia::render('Settings');
    })->name('settings');
    Route::post('/settings/edit', 'update')->name('settings/edit');
});

/** Analytics Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('analytics', function () {
        return Inertia::render('Analytics');
    })->name('analytics');
});

/** User Routes */
Route::controller(RegisteredUserController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/users/balance', 'getBalance')->name('/users/balance');
    Route::get('/users', 'getUser')->name('/users');
});

require __DIR__ . '/auth.php';
