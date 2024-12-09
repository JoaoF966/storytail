<?php

namespace App\Storage\Repository;

use App\Models\Tag;
use App\Storage\FindsTags;
use App\Storage\StoresTag;
use Illuminate\Support\Collection;

class TagRepository implements StoresTag, FindsTags
{

    public function store(Tag $tag): void
    {
        $tag->save();
    }

    public function getAllTags(): Collection
    {
        return Tag::all();
    }

    public function findById(int $id): ?Tag
    {
        return Tag::find($id);
    }
}
