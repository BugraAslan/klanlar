<?php

namespace App\Model\Response;

class CostResponse
{
    /** @var int */
    protected $wood;

    /** @var int */
    protected $clay;

    /** @var int */
    protected $iron;

    /** @var int */
    protected $population;

    /**
     * @return int
     */
    public function getWood(): int
    {
        return $this->wood;
    }

    /**
     * @param int $wood
     * @return CostResponse
     */
    public function setWood(int $wood): CostResponse
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
     * @return CostResponse
     */
    public function setClay(int $clay): CostResponse
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
     * @return CostResponse
     */
    public function setIron(int $iron): CostResponse
    {
        $this->iron = $iron;
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
     * @return CostResponse
     */
    public function setPopulation(int $population): CostResponse
    {
        $this->population = $population;
        return $this;
    }
}