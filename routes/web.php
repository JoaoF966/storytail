<?php

use App\Http\Controllers\Api\BookController as ApiBookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('tag.index');
    Route::post('/', [TagController::class, 'create'])->name('tag.create');
})->middleware(['auth', 'verified']);


Route::get('/book/{id}', function ($id) {
    return view('book_page');
})->name('book.page');

Route::prefix('api')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [ApiBookController::class, 'list'])->name('api.books.list');;
    });
});

require __DIR__.'/auth.php';
