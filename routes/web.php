<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

info('flag is '. (Route::has('login') ? 'true' : 'false'));

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tasks')->name('tasks.')->group(function () {
        Route::post('/', [TaskController::class, 'store'])->name('store');
    });
});

Route::put('/locale/{locale}', function($locale) {
    session(['locale' => $locale]);
})->name('locale.put');

require __DIR__.'/auth.php';
