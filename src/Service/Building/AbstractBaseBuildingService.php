<?php

namespace App\Service\Building;

use App\Entity\VillageBuilding;
use App\Service\BaseService;

abstract class AbstractBaseBuildingService extends BaseService
{
    protected function getUnitRequirements(VillageBuilding $villageBuilding)
    {
        if ($villageBuilding->getBuilding()->getUnitManufacturers()->count()){
            // TODO unit requirements
        }
    }

    /**
     * @param VillageBuilding $villageBuilding
     * @return bool
     */
    protected function isUnitManufacturer(VillageBuilding $villageBuilding)
    {
        return (bool)$villageBuilding->getBuilding()->getUnitManufacturers()->count();
    }
}