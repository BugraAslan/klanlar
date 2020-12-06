<?php

namespace App\Model\Response\Building;

use App\Model\Response\CostResponse;

class BuildingRequirementResponse
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
    protected $currentLevel;

    /** @var string */
    protected $buildTime;

    /** @var int */
    protected $buildLevel;

    /** @var bool */
    protected $isBuildable;

    /** @var string|null */
    protected $buildableMessage;

    /** @var string */
    protected $buildableTime;

    /** @var bool */
    protected $hasMaxLevel;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BuildingRequirementResponse
     */
    public function setId(int $id): BuildingRequirementResponse
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
     * @return BuildingRequirementResponse
     */
    public function setName(string $name): BuildingRequirementResponse
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
     * @return BuildingRequirementResponse
     */
    public function setIconUrl(string $iconUrl): BuildingRequirementResponse
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
     * @return BuildingRequirementResponse
     */
    public function setCosts(CostResponse $costs): BuildingRequirementResponse
    {
        $this->costs = $costs;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentLevel(): int
    {
        return $this->currentLevel;
    }

    /**
     * @param int $currentLevel
     * @return BuildingRequirementResponse
     */
    public function setCurrentLevel(int $currentLevel): BuildingRequirementResponse
    {
        $this->currentLevel = $currentLevel;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuildTime(): string
    {
        return $this->buildTime;
    }

    /**
     * @param string $buildTime
     * @return BuildingRequirementResponse
     */
    public function setBuildTime(string $buildTime): BuildingRequirementResponse
    {
        $this->buildTime = $buildTime;
        return $this;
    }

    /**
     * @return int
     */
    public function getBuildLevel(): int
    {
        return $this->buildLevel;
    }

    /**
     * @param int $buildLevel
     * @return BuildingRequirementResponse
     */
    public function setBuildLevel(int $buildLevel): BuildingRequirementResponse
    {
        $this->buildLevel = $buildLevel;
        return $this;
    }

    /**
     * @return bool
     */
    public function isBuildable(): bool
    {
        return $this->isBuildable;
    }

    /**
     * @param bool $isBuildable
     * @return BuildingRequirementResponse
     */
    public function setIsBuildable(bool $isBuildable): BuildingRequirementResponse
    {
        $this->isBuildable = $isBuildable;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBuildableMessage(): ?string
    {
        return $this->buildableMessage;
    }

    /**
     * @param string|null $buildableMessage
     * @return BuildingRequirementResponse
     */
    public function setBuildableMessage(?string $buildableMessage): BuildingRequirementResponse
    {
        $this->buildableMessage = $buildableMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuildableTime(): string
    {
        return $this->buildableTime;
    }

    /**
     * @param string $buildableTime
     * @return BuildingRequirementResponse
     */
    public function setBuildableTime(string $buildableTime): BuildingRequirementResponse
    {
        $this->buildableTime = $buildableTime;
        return $this;
    }

    /**
     * @return bool
     */
    public function isHasMaxLevel(): bool
    {
        return $this->hasMaxLevel;
    }

    /**
     * @param bool $hasMaxLevel
     * @return BuildingRequirementResponse
     */
    public function setHasMaxLevel(bool $hasMaxLevel): BuildingRequirementResponse
    {
        $this->hasMaxLevel = $hasMaxLevel;
        return $this;
    }
}