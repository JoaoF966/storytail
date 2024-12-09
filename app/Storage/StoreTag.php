<?php

namespace App\Storage;

use App\Models\Tag;

interface StoreTag
{
    public function store(Tag $tag): void;
}
