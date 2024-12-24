<?php

namespace App\Storage;

use App\Models\Book;

interface StoresBook
{
    public function store(Book $book): void;

    public function delete(Book $book): void;
}
