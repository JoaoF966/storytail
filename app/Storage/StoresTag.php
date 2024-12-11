<?php

namespace App\Storage;

use App\Models\Tag;

interface StoresTag
{
    public function store(Tag $tag): void;
    public function delete(Tag $tag): void;
}
