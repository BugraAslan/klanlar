<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
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
     * @param BuildingDetailRequest $buildingDetailRequest
     * @return UnitManufacturerBuildingDetailResponse|null
     */
    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest): ?UnitManufacturerBuildingDetailResponse
    {
        return $this->getUnitManufacturerBuildingDetail($buildingDetailRequest);
    }
}