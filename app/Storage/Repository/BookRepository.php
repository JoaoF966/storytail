<?php

namespace App\Storage\Repository;

use App\Models\Book;
use App\Storage\FindBooks;
use Illuminate\Support\Collection;

class BookRepository implements FindBooks
{
    /**
     * @return Collection<Book>
     */
    public function findAllBooks(): Collection
    {
        return Book::all();
    }
}
