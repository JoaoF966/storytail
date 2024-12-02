<?php

namespace App\Services;

use App\Models\Book;
use App\Storage\FindBooks;
use Illuminate\Support\Collection;

class BookService
{
    public function __construct(
        private readonly FindBooks $books
    ) {
    }

    /**
     * @return Collection<Book>
     */
    public function getAll(): Collection
    {
        // Your service logic here
        return $this->books->findAllBooks();
    }
}
