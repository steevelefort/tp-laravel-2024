<?php

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [APIController::class, "login"]);

Route::get('/test', [APIController::class, 'test'])->middleware('auth:sanctum');
Route::get('/products', [APIController::class, "products"]);

