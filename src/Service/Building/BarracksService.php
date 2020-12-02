<?php

namespace App\Service\Building;

use App\Entity\VillageBuilding;
use App\Strategy\BuildingStrategyInterface;

class BarracksService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Kışla';

    /**
     * @param string $buildingName
     * @return bool
     */
    public function canHandle(string $buildingName)
    {
        return self::BUILDING_NAME === $buildingName;
    }

    public function buildingDetail(VillageBuilding $villageBuilding)
    {
        if ($this->isUnitManufacturer($villageBuilding)){
            return $this->getUnitManufacturerBuildingDetail($villageBuilding);
        }

        return 'Kışla';
    }
}