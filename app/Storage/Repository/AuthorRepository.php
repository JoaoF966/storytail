<?php

namespace App\Storage\Repository;

use App\Models\Author;
use App\Storage\StoresAuthor;

class AuthorRepository implements StoresAuthor
{
    public function store(Author $author): void
    {
        $author->save();
    }
}
