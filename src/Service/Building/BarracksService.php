<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Service\BaseService;
use App\Strategy\BuildingStrategyInterface;

class BarracksService extends BaseService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Kışla';

    public function canHandle(string $buildingName)
    {
        return self::BUILDING_NAME === $buildingName;
    }

    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        return 'Kışla';
    }
}