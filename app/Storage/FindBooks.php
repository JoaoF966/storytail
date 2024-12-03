<?php

namespace App\Storage;

use App\Models\Book;
use Illuminate\Support\Collection;

interface FindBooks
{
    /**
     * @return Collection<Book>
     */
    public function findAllBooks(): Collection;
}
