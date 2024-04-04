<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('home');
Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('categories', [CategoryController::class, 'adminIndex'])->name('categories.index');
    Route::get('categories/show/{category}', [CategoryController::class, 'adminShow'])->name('categories.show');
    Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');

    Route::post('categories/{category}/addBlog', [CategoryController::class, 'addBlog'])->name('categories.addBlog');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category}/removeBlog/{blog}', [CategoryController::class, 'removeBlog'])->name('categories.removeBlog');

    Route::resource('categories', CategoryController::class)->except(['index', 'show', 'create']);

    Route::get('blogs', [BlogController::class, 'adminIndex'])->name('blogs.index');
    Route::get('blogs/show/{blog}', [BlogController::class, 'adminShow'])->name('blogs.show');
    Route::get('blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::put('blogs/{blog}/updateCategories', [BlogController::class, 'updateCategories'])->name('blogs.updateCategories');
    Route::resource('blogs', BlogController::class)->except(['index', 'create']);
    Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
    Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('blogs/{blog}/removeCategory/{category}', [BlogController::class, 'removeCategoryFromBlog'])->name('blogs.removeCategoryFromBlog');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');
