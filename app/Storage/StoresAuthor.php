<?php

namespace App\Storage;

use App\Models\Author;

interface StoresAuthor
{
    public function store(Author $author): void;
}
