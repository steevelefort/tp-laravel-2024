<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, "viewAll"]);

Route::get('/details/{id}', [ProductController::class, "details"]);
Route::get('/add/{id}', [ProductController::class, "add"]);
Route::get('/cart', [ProductController::class, "cart"]);


Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/product/create', [ProductController::class, "create"]);
    Route::post('/product/create', [ProductController::class, "store"]);

    Route::get('/product/modify/{id}', [ProductController::class, "modify"]);
    Route::put('/product/modify/{id}', [ProductController::class, "update"]);

    Route::delete('/product/delete/{id}', [ProductController::class, "delete"]);
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
