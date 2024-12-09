<?php

namespace App\Services;

use App\Models\Tag;
use App\Storage\FindsTags;
use App\Storage\StoreTag;
use Illuminate\Support\Collection;

readonly class TagService
{
    public function __construct(
        private readonly StoreTag $storeTag,
        private readonly FindsTags $tags,
    ) {
    }

    public function storeTag(string $tagName): void {
        $tag = new Tag();
        $tag->name = $tagName;

        $this->storeTag->store($tag);
    }

    /**
     * @return Collection<Tag>
     */
    public function getAllTags(): Collection
    {
        return $this->tags->getAllTags();
    }
}
