<?php

namespace App\Storage;

use App\Models\Book;
use App\Models\Page;

interface StoresBook
{
    public function store(Book $book): void;

    /**
     * @param Book $book
     * @param Page[] $pages
     * @return void
     */
    public function storePages(Book $book, array $pages): void;
    public function delete(Book $book): void;
    public function deletePages(Book $book): void;
}
