<?php

namespace App\Storage;

use App\Models\AgeGroup;
use Illuminate\Support\Collection;

interface FindsAgeGroups
{
    /**
     * @return Collection<AgeGroup>
     */
    public function getAllAgeGroups(): Collection;

    public function findById(int $id): ?AgeGroup;
}
