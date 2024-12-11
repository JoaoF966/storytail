<?php

namespace App\Storage\Repository;

use App\Models\Author;
use App\Storage\FindsAuthors;
use App\Storage\StoresAuthor;
use Illuminate\Support\Collection;

class AuthorsRepository implements StoresAuthor, FindsAuthors
{
    public function store(Author $author): void
    {
        $author->save();
    }

    /**
     * @return Collection<Author>
     */
    public function getAllAuthors(): Collection
    {
        return Author::all();
    }

    public function findById(int $id): ?Author
    {
        return Author::find($id);
    }

    public function delete(Author $author): void
    {
        $author->delete();
    }
}
