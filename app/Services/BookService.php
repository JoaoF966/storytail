<?php

namespace App\Services;

use App\Http\Filters\BookFilter;
use App\Models\Book;
use App\Storage\FindsBooks;
use Illuminate\Support\Collection;

readonly class BookService
{
    public function __construct(
        private FindsBooks $books
    ) {
    }

    /**
     * @return Collection<Book>
     */
    public function getAllBooks(): Collection
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

    /**
     * @return Collection<Book>
     */
    public function getFilteredBooks(BookFilter $bookFilter): Collection
    {
        return $this->books->findBooksByBookFilter($bookFilter);
    }
}
