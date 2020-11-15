<?php

namespace App\Model\Response\Village\VillageInfo;

class BuildingByVillageInfoResponse
{
    /** @var int */
    private $buildingId;

    /** @var string */
    private $buildingName;

    /** @var int */
    private $buildingLevel;

    /** @var string */
    private $buildingIcon;

    /**
     * @return int
     */
    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    /**
     * @param int $buildingId
     * @return BuildingByVillageInfoResponse
     */
    public function setBuildingId(int $buildingId): BuildingByVillageInfoResponse
    {
        $this->buildingId = $buildingId;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuildingName(): string
    {
        return $this->buildingName;
    }

    /**
     * @param string $buildingName
     * @return BuildingByVillageInfoResponse
     */
    public function setBuildingName(string $buildingName): BuildingByVillageInfoResponse
    {
        $this->buildingName = $buildingName;
        return $this;
    }

    /**
     * @return int
     */
    public function getBuildingLevel(): int
    {
        return $this->buildingLevel;
    }

    /**
     * @param int $buildingLevel
     * @return BuildingByVillageInfoResponse
     */
    public function setBuildingLevel(int $buildingLevel): BuildingByVillageInfoResponse
    {
        $this->buildingLevel = $buildingLevel;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuildingIcon(): string
    {
        return $this->buildingIcon;
    }

    /**
     * @param string $buildingIcon
     * @return BuildingByVillageInfoResponse
     */
    public function setBuildingIcon(string $buildingIcon): BuildingByVillageInfoResponse
    {
        $this->buildingIcon = $buildingIcon;
        return $this;
    }
}