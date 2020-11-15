<?php

namespace App\Model\Response\Village\VillageInfo;

class UnitByVillageInfoResponse
{
    /** @var int */
    private $unitId;

    /** @var int */
    private $unitCount;

    /** @var string */
    private $unitName;

    /** @var string */
    private $unitIcon;

    /**
     * @return int
     */
    public function getUnitId(): int
    {
        return $this->unitId;
    }

    /**
     * @param int $unitId
     * @return UnitByVillageInfoResponse
     */
    public function setUnitId(int $unitId): UnitByVillageInfoResponse
    {
        $this->unitId = $unitId;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitCount(): int
    {
        return $this->unitCount;
    }

    /**
     * @param int $unitCount
     * @return UnitByVillageInfoResponse
     */
    public function setUnitCount(int $unitCount): UnitByVillageInfoResponse
    {
        $this->unitCount = $unitCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitName(): string
    {
        return $this->unitName;
    }

    /**
     * @param string $unitName
     * @return UnitByVillageInfoResponse
     */
    public function setUnitName(string $unitName): UnitByVillageInfoResponse
    {
        $this->unitName = $unitName;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitIcon(): string
    {
        return $this->unitIcon;
    }

    /**
     * @param string $unitIcon
     * @return UnitByVillageInfoResponse
     */
    public function setUnitIcon(string $unitIcon): UnitByVillageInfoResponse
    {
        $this->unitIcon = $unitIcon;
        return $this;
    }
}