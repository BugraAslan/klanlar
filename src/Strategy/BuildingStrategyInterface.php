<?php

namespace App\Strategy;

use App\Model\Request\Building\BuildingDetailRequest;

interface BuildingStrategyInterface
{
    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest);

    public function canHandle(string $buildingName);
}