<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\ResourceManufacturerBuildingDetailResponse;
use App\Strategy\BuildingStrategyInterface;

class WoodService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Oduncu Kampı';

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
     * @return ResourceManufacturerBuildingDetailResponse|null
     */
    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest): ?ResourceManufacturerBuildingDetailResponse
    {
        return $this->getResourceManufacturerBuildingDetail($buildingDetailRequest);
    }
}