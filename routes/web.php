<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/about', [AboutController::class, 'index'])->name('about'); #Tambahkan route untuk halaman about
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // About
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

    // ✅ Semua pakai {product}, bukan {id}
    Route::middleware(['can:manage-product'])->group(function () {
        Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/product/delete/{product}', [ProductController::class, 'delete'])->name('product.delete');
    });
    // Todo — semua user yang login bisa akses
    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/edit/{todo}', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/update/{todo}', [TodoController::class, 'update'])->name('todo.update');
    Route::patch('/todo/complete/{todo}', [TodoController::class, 'complete'])->name('todo.complete');
    Route::delete('/todo/delete/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

    // Category — semua user yang login bisa akses
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});



require __DIR__.'/auth.php';
