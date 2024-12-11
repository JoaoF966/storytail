<?php

namespace App\Storage\Repository;

use App\Models\AgeGroup;
use App\Storage\FindsAgeGroups;
use App\Storage\StoresAgeGroup;
use Illuminate\Support\Collection;

class AgeGroupRepository implements StoresAgeGroup, FindsAgeGroups
{
    public function store(AgeGroup $ageGroup): void
    {
        $ageGroup->save();
    }

    /**
     * @return Collection<AgeGroup>
     */
    public function getAllAgeGroups(): Collection
    {
        return AgeGroup::all()->sortBy('age_group');
    }

    public function findById(int $id): ?AgeGroup
    {
        return AgeGroup::find($id);
    }

    public function delete(AgeGroup $ageGroup): void
    {
        $ageGroup->delete();
    }
}
