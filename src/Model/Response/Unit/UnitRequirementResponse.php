<?php

namespace App\Model\Response\Unit;

use App\Model\Response\CostResponse;

class UnitRequirementResponse
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $iconUrl;

    /** @var CostResponse */
    protected $costs;

    /** @var int */
    protected $existingCount;

    /** @var float */
    protected $buildTime;

    /** @var int */
    protected $buildCount;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UnitRequirementResponse
     */
    public function setId(int $id): UnitRequirementResponse
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UnitRequirementResponse
     */
    public function setName(string $name): UnitRequirementResponse
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    /**
     * @param string $iconUrl
     * @return UnitRequirementResponse
     */
    public function setIconUrl(string $iconUrl): UnitRequirementResponse
    {
        $this->iconUrl = $iconUrl;
        return $this;
    }

    /**
     * @return CostResponse
     */
    public function getCosts(): CostResponse
    {
        return $this->costs;
    }

    /**
     * @param CostResponse $costs
     * @return UnitRequirementResponse
     */
    public function setCosts(CostResponse $costs): UnitRequirementResponse
    {
        $this->costs = $costs;
        return $this;
    }

    /**
     * @return int
     */
    public function getExistingCount(): int
    {
        return $this->existingCount;
    }

    /**
     * @param int $existingCount
     * @return UnitRequirementResponse
     */
    public function setExistingCount(int $existingCount): UnitRequirementResponse
    {
        $this->existingCount = $existingCount;
        return $this;
    }

    /**
     * @return float
     */
    public function getBuildTime(): float
    {
        return $this->buildTime;
    }

    /**
     * @param float $buildTime
     * @return UnitRequirementResponse
     */
    public function setBuildTime(float $buildTime): UnitRequirementResponse
    {
        $this->buildTime = $buildTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getBuildCount(): int
    {
        return $this->buildCount;
    }

    /**
     * @param int $buildCount
     * @return UnitRequirementResponse
     */
    public function setBuildCount(int $buildCount): UnitRequirementResponse
    {
        $this->buildCount = $buildCount;
        return $this;
    }
}