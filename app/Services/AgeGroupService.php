<?php

namespace App\Services;

use App\Exceptions\AgeGroupNotFoundException;
use App\Models\AgeGroup;
use App\Storage\FindsAgeGroups;
use App\Storage\StoresAgeGroup;
use App\ValueObject\AgeGroup as AgeGroupValueObject;
use Illuminate\Support\Collection;

class AgeGroupService
{
    public function __construct(
        private readonly StoresAgeGroup $store,
        private readonly FindsAgeGroups $ageGroups,
    ) {
    }

    public function storeAgeGroup(AgeGroupValueObject $ageGroupValueObject): void
    {
        $ageGroup = new AgeGroup();

        $ageGroup->age_group = (string)$ageGroupValueObject;

        $this->store->store($ageGroup);
    }

    public function getAllAgeGroups(): Collection
    {
        return $this->ageGroups->getAllAgeGroups();
    }

    public function updateAgeGroup(AgeGroupValueObject $fromString, int $id): void
    {
        $ageGroup = $this->findAgeGroupById($id);

        $ageGroup->age_group = (string)$fromString;

        $this->store->store($ageGroup);
    }

    private function findAgeGroupById(int $id): AgeGroup
    {
        if ($ageGroup = $this->ageGroups->findById($id)) {
            return $ageGroup;
        }

        throw AgeGroupNotFoundException::fromId($id);
    }

    public function deleteAgeGroup(int $id)
    {
        $ageGroup = $this->findAgeGroupById($id);

        $this->ageGroups->delete($ageGroup);
    }
}
