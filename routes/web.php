<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, "viewAll"]);

Route::get('/details/{id}', [ProductController::class, "details"]);
Route::get('/add/{id}', [ProductController::class, "add"]);
Route::get('/cart', [ProductController::class, "cart"]);
