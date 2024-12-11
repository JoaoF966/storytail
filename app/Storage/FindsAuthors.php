<?php

namespace App\Storage;

use App\Models\Author;
use Illuminate\Support\Collection;

interface FindsAuthors
{
    /**
     * @return Collection<Author>
     */
    public function getAllAuthors(): Collection;
    public function findById(int $id): ?Author;
}
