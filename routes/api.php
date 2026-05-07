<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

// Auth
Route::post('/login', [AuthController::class, 'getToken']);

// Product - public
Route::get('/product',      [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// Category - public
Route::get('/category',      [CategoryController::class, 'index']);
Route::get('/category/{id}', [CategoryController::class, 'show']);

// Protected (butuh Bearer Token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product',        [ProductController::class, 'store']);
    Route::put('/product/{id}',    [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    Route::post('/category',        [CategoryController::class, 'store']);
    Route::put('/category/{id}',    [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
});