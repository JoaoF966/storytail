<?php

namespace App\Storage;

use App\Models\AgeGroup;

interface StoresAgeGroup
{
    public function store(AgeGroup $ageGroup): void;
    public function delete(AgeGroup $ageGroup): void;
}
