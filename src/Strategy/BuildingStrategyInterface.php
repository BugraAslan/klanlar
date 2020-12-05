<?php

namespace App\Strategy;

use App\Entity\VillageBuilding;

interface BuildingStrategyInterface
{
    public function buildingDetail(VillageBuilding $villageBuilding);

    public function canHandle(string $buildingName);
}