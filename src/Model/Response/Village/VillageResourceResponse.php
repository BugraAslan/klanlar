<?php

namespace App\Model\Response\Village;

class VillageResourceResponse
{
    /** @var int */
    private $wood;

    /** @var int */
    private $clay;

    /** @var int */
    private $iron;

    /** @var int */
    private $warehouse;

    /** @var int */
    private $population;

    /**
     * @return int
     */
    public function getWood(): int
    {
        return $this->wood;
    }

    /**
     * @param int $wood
     * @return VillageResourceResponse
     */
    public function setWood(int $wood): VillageResourceResponse
    {
        $this->wood = $wood;
        return $this;
    }

    /**
     * @return int
     */
    public function getClay(): int
    {
        return $this->clay;
    }

    /**
     * @param int $clay
     * @return VillageResourceResponse
     */
    public function setClay(int $clay): VillageResourceResponse
    {
        $this->clay = $clay;
        return $this;
    }

    /**
     * @return int
     */
    public function getIron(): int
    {
        return $this->iron;
    }

    /**
     * @param int $iron
     * @return VillageResourceResponse
     */
    public function setIron(int $iron): VillageResourceResponse
    {
        $this->iron = $iron;
        return $this;
    }

    /**
     * @return int
     */
    public function getWarehouse(): int
    {
        return $this->warehouse;
    }

    /**
     * @param int $warehouse
     * @return VillageResourceResponse
     */
    public function setWarehouse(int $warehouse): VillageResourceResponse
    {
        $this->warehouse = $warehouse;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @param int $population
     * @return VillageResourceResponse
     */
    public function setPopulation(int $population): VillageResourceResponse
    {
        $this->population = $population;
        return $this;
    }
}