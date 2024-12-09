<?php

namespace App\Storage;

use App\Models\Tag;
use Illuminate\Support\Collection;

interface FindsTags
{
    /**
     * @return Collection<Tag>
     */
    public function getAllTags(): Collection;
    public function findById(int $id): ?Tag;
}
