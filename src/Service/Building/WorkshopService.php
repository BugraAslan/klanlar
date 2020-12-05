<?php

namespace App\Service\Building;

use App\Entity\VillageBuilding;
use App\Model\Response\Building\UnitManufacturerBuildingDetailResponse;
use App\Strategy\BuildingStrategyInterface;

class WorkshopService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Atölye';

    /**
     * @param string $buildingName
     * @return bool
     */
    public function canHandle(string $buildingName): bool
    {
        return self::BUILDING_NAME === $buildingName;
    }

    /**
     * @param VillageBuilding $villageBuilding
     * @return UnitManufacturerBuildingDetailResponse|null
     */
    public function buildingDetail(VillageBuilding $villageBuilding): ?UnitManufacturerBuildingDetailResponse
    {
        $buildingDetail = null;
        if ($this->isUnitManufacturer($villageBuilding)){
            $buildingDetail = $this->getUnitManufacturerBuildingDetail($villageBuilding);
        }

        return $buildingDetail;
    }
}