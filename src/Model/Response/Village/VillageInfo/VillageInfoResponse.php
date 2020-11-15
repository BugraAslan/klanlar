<?php

namespace App\Model\Response\Village\VillageInfo;

use App\Model\Response\Village\VillageResponse;

class VillageInfoResponse
{
    /** @var VillageResponse */
    private $village;

    /** @var BuildingByVillageInfoResponse[] */
    private $buildings;

    /** @var array */
    private $materials;

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
     * @return array
     */
    public function getMaterials(): array
    {
        return $this->materials;
    }

    /**
     * @param array $materials
     * @return VillageInfoResponse
     */
    public function setMaterials(array $materials): VillageInfoResponse
    {
        $this->materials = $materials;
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