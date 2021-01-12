<?php

namespace App\Model\Response\Unit;

use App\Model\Response\CostResponse;

class UnitFounderResponse
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
    protected $level;

    /** @var boolean */
    protected $isFound;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UnitFounderResponse
     */
    public function setId(int $id): UnitFounderResponse
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
     * @return UnitFounderResponse
     */
    public function setName(string $name): UnitFounderResponse
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
     * @return UnitFounderResponse
     */
    public function setIconUrl(string $iconUrl): UnitFounderResponse
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
     * @return UnitFounderResponse
     */
    public function setCosts(CostResponse $costs): UnitFounderResponse
    {
        $this->costs = $costs;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return UnitFounderResponse
     */
    public function setLevel(int $level): UnitFounderResponse
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return bool
     */
    public function isFound(): bool
    {
        return $this->isFound;
    }

    /**
     * @param bool $isFound
     * @return UnitFounderResponse
     */
    public function setIsFound(bool $isFound): UnitFounderResponse
    {
        $this->isFound = $isFound;
        return $this;
    }
}