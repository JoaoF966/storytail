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
        return $this->books->findAllBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getCurrentMonthBooks(): Collection
    {
        return $this->books->findCurrentMonthBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getJustAddedBooks(): Collection
    {
        return $this->books->findJustAddedBooks();
    }

    /**
     * @return Collection<Book>
     */
    public function getTopReadBooks(): Collection {
        return $this->books->findTopReadBooks();
    }
}
