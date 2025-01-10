<?php

use App\Http\Controllers\Admin\AgeGroupController as AdminAgeGroupController;
use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Api\BookController as ApiBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tags')->group(function () {
        Route::get('/', [AdminTagController::class, 'index'])->name('admin.tag.index');
        Route::post('/', [AdminTagController::class, 'create'])->name('admin.tag.create');
        Route::put('/{id}', [AdminTagController::class, 'update'])->name('admin.tag.edit');
        Route::delete('/{id}', [AdminTagController::class, 'destroy'])->name('admin.tag.destroy');
    });

    Route::prefix('authors')->group(function () {
        Route::get('/', [AdminAuthorController::class, 'index'])->name('admin.author.index');
        Route::post('/', [AdminAuthorController::class, 'create'])->name('admin.author.create');
        Route::put('/{id}', [AdminAuthorController::class, 'edit'])->name('admin.author.edit');
        Route::delete('/{id}', [AdminAuthorController::class, 'destroy'])->name('admin.author.destroy');
    });

    Route::prefix('books')->group(function () {
        Route::get('/', [AdminBookController::class, 'index'])->name('admin.book.index');
        Route::post('/', [AdminBookController::class, 'create'])->name('admin.book.create');
        Route::put('/{id}', [AdminBookController::class, 'edit'])->name('admin.book.edit');
        Route::delete('/{id}', [AdminBookController::class, 'destroy'])->name('admin.book.destroy');
    });

    Route::prefix('age_groups')->group(function () {
        Route::get('/', [AdminAgeGroupController::class, 'index'])->name('admin.age_group.index');
        Route::post('/', [AdminAgeGroupController::class, 'create'])->name('admin.age_group.create');
        Route::put('/{id}', [AdminAgeGroupController::class, 'edit'])->name('admin.age_group.edit');
        Route::delete('/{id}', [AdminAgeGroupController::class, 'destroy'])->name('admin.age_group.destroy');
    });
})->middleware(['auth', 'verified']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/book/{id}/read', [BookController::class, 'read'])->name('book.read');
Route::get('/book/{id}/page/{page}', [BookController::class, 'loadPage'])->name('book.page.dynamic');
Route::get('/book/{id}/load-page/{page}', [BookController::class, 'ajaxLoadPage'])->name('book.page.ajax');
Route::get('/books/filter', [BookController::class, 'filter'])->name('books.filter');

Route::get('/book/{id}', [BookController::class, 'view'])->name('book.page');
Route::post('/books/{id}/rate', [RatingController::class, 'rateBook'])->middleware('auth')->name('books.rate');

Route::prefix('api')->group(function () {
    Route::prefix('books')->group(function () {
        Route::get('/', [ApiBookController::class, 'list'])->name('api.books.list');;
    });

    Route::prefix('admin')->group(function () {
        Route::post('/books/{id}/import', [AdminBookController::class, 'import'])->name('api.admin.book.import');
    });
});

Route::get('/search', [HomeController::class, 'search'])->name('home.search');

require __DIR__ . '/auth.php';
