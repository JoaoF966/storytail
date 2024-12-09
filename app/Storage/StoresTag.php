<?php

namespace App\Storage;

use App\Models\Tag;

interface StoresTag
{
    public function store(Tag $tag): void;
}
