<?php

namespace App\Services;

use App\Exceptions\TagNotFoundException;
use App\Models\Tag;
use App\Storage\FindsTags;
use App\Storage\StoresTag;
use Illuminate\Support\Collection;

readonly class TagService
{
    public function __construct(
        private StoresTag $storeTag,
        private FindsTags $tags,
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

    public function updateTag(int $id, string $tagName): void
    {
        $tag = $this->findTagById($id);

        $tag->name = $tagName;

        $tag->save();
    }

    private function findTagById(int $id): Tag
    {
        if ($tag = $this->tags->findById($id)) {
            return $tag;
        }

        throw TagNotFoundException::fromId($id);
    }

    public function deleteTag(int $id): void
    {
        $tag = $this->findTagById($id);
        $tag->delete();
    }
}
