<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Service\BaseService;
use App\Strategy\BuildingStrategyInterface;

class MainBuildingService extends BaseService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Ana Bina';

    public function canHandle(string $buildingName)
    {
        return self::BUILDING_NAME === $buildingName;
    }

    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        return 'Ana Bina';
    }
}