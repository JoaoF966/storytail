<?php

namespace App\Storage\Repository;

use App\Models\Tag;
use App\Storage\FindsTags;
use App\Storage\StoreTag;
use Illuminate\Support\Collection;

class TagRepository implements StoreTag, FindsTags
{

    public function store(Tag $tag): void
    {
        $tag->save();
    }

    public function getAllTags(): Collection
    {
        return Tag::all();
    }
}
