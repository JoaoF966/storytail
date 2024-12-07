<?php

namespace App\Storage;

use App\Http\Filters\BookFilter;
use App\Models\Book;
use Illuminate\Support\Collection;

interface FindBooks
{
    /**
     * @return Collection<Book>
     */
    public function findAllBooks(): Collection;
    /**
     * @return Collection<Book>
     */
    public function findCurrentMonthBooks(): Collection;
    /**
     * @return Collection<Book>
     */
    public function findJustAddedBooks(): Collection;
    /**
     * @return Collection<Book>
     */
    public function findTopReadBooks(): Collection;
    /**
     * @return Collection<Book>
     */
    public function findBooksByBookFilter(BookFilter $bookFilter): Collection;
}
