<?php

namespace App\Model\Response\Building;

use App\Model\Response\EffectResponse;

class ResourceManufacturerBuildingDetailResponse extends BaseBuildingDetailResponse
{
    /** @var EffectResponse[]|array */
    protected $resourceEffects;

    /** @var int */
    protected $currentManufactureCount;

    /** @var int */
    protected $nextManufactureCount;

    /** @var bool */
    protected $hasMaxLevel;

    /**
     * @return EffectResponse[]|array
     */
    public function getResourceEffects(): array
    {
        return $this->resourceEffects;
    }

    /**
     * @param EffectResponse[]|array $resourceEffects
     * @return ResourceManufacturerBuildingDetailResponse
     */
    public function setResourceEffects(array $resourceEffects): ResourceManufacturerBuildingDetailResponse
    {
        $this->resourceEffects = $resourceEffects;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentManufactureCount(): int
    {
        return $this->currentManufactureCount;
    }

    /**
     * @param int $currentManufactureCount
     * @return ResourceManufacturerBuildingDetailResponse
     */
    public function setCurrentManufactureCount(int $currentManufactureCount): ResourceManufacturerBuildingDetailResponse
    {
        $this->currentManufactureCount = $currentManufactureCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getNextManufactureCount(): int
    {
        return $this->nextManufactureCount;
    }

    /**
     * @param int $nextManufactureCount
     * @return ResourceManufacturerBuildingDetailResponse
     */
    public function setNextManufactureCount(int $nextManufactureCount): ResourceManufacturerBuildingDetailResponse
    {
        $this->nextManufactureCount = $nextManufactureCount;
        return $this;
    }

    /**
     * @return bool
     */
    public function getHasMaxLevel(): bool
    {
        return $this->hasMaxLevel;
    }

    /**
     * @param bool $hasMaxLevel
     * @return ResourceManufacturerBuildingDetailResponse
     */
    public function setHasMaxLevel(bool $hasMaxLevel): ResourceManufacturerBuildingDetailResponse
    {
        $this->hasMaxLevel = $hasMaxLevel;
        return $this;
    }
}