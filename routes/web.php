<?php

use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Api\BookController as ApiBookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('tag.index');
        Route::post('/', [TagController::class, 'create'])->name('tag.create');
        Route::put('/{id}', [TagController::class, 'edit'])->name('tag.edit');
        Route::delete('/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
    });

    Route::prefix('authors')->group(function () {
        Route::get('/', [AdminAuthorController::class, 'index'])->name('author.index');
        Route::post('/', [AdminAuthorController::class, 'create'])->name('author.create');
        Route::put('/{id}', [AdminAuthorController::class, 'edit'])->name('author.edit');
        Route::delete('/{id}', [AdminAuthorController::class, 'destroy'])->name('author.destroy');
    });

    Route::prefix('books')->group(function () {
        Route::get('/', [AdminBookController::class, 'index'])->name('book.index');
    });
})->middleware(['auth', 'verified']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/book/{id}', function ($id) {
    return view('book_page');
})->name('book.page');

Route::prefix('api')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [ApiBookController::class, 'list'])->name('api.books.list');;
    });
});

require __DIR__ . '/auth.php';
