<?php

namespace App\Service\Building;

use App\Entity\VillageBuilding;
use App\Strategy\BuildingStrategyInterface;

class MainBuildingService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Ana Bina';

    public function canHandle(string $buildingName)
    {
        return self::BUILDING_NAME === $buildingName;
    }

    public function buildingDetail(VillageBuilding $villageBuilding)
    {
        return 'Ana Bina';
    }
}