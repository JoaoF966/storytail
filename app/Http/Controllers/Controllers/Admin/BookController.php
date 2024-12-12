<?php

namespace App\Http\Controllers\Controllers\Admin;

use App\Services\BookService;

class BookController
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    public function index() {
        $books = $this->bookService->getAllBooks();

        return view('admin.book.index', [
            'books' => $books,
        ]);
    }
}
