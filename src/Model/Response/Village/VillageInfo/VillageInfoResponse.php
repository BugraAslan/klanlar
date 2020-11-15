<?php

namespace App\Model\Response\Village\VillageInfo;

use App\Model\Response\Village\VillageResourceResponse;
use App\Model\Response\Village\VillageResponse;

class VillageInfoResponse
{
    /** @var VillageResponse */
    private $village;

    /** @var BuildingByVillageInfoResponse[] */
    private $buildings;

    /** @var VillageResourceResponse */
    private $resources;

    /** @var UnitByVillageInfoResponse[] */
    private $units;

    /**
     * @return VillageResponse
     */
    public function getVillage(): VillageResponse
    {
        return $this->village;
    }

    /**
     * @param VillageResponse $village
     * @return VillageInfoResponse
     */
    public function setVillage(VillageResponse $village): VillageInfoResponse
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return BuildingByVillageInfoResponse[]
     */
    public function getBuildings(): array
    {
        return $this->buildings;
    }

    /**
     * @param BuildingByVillageInfoResponse[] $buildings
     * @return VillageInfoResponse
     */
    public function setBuildings(array $buildings): VillageInfoResponse
    {
        $this->buildings = $buildings;
        return $this;
    }

    /**
     * @return VillageResourceResponse
     */
    public function getResources(): VillageResourceResponse
    {
        return $this->resources;
    }

    /**
     * @param VillageResourceResponse $resources
     * @return VillageInfoResponse
     */
    public function setResources(VillageResourceResponse $resources): VillageInfoResponse
    {
        $this->resources = $resources;
        return $this;
    }

    /**
     * @return UnitByVillageInfoResponse[]
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * @param UnitByVillageInfoResponse[] $units
     * @return VillageInfoResponse
     */
    public function setUnits(array $units): VillageInfoResponse
    {
        $this->units = $units;
        return $this;
    }
}