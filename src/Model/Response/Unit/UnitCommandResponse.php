<?php

namespace App\Model\Response\Unit;

use App\Model\Response\CostResponse;

class UnitCommandResponse
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $iconUrl;

    /** @var int */
    protected $commandCount;

    /** @var string */
    protected $endDate;

    /** @var string */
    protected $remainingTime;

    /** @var CostResponse */
    protected $costs;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return UnitCommandResponse
     */
    public function setName(string $name): UnitCommandResponse
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
     * @return UnitCommandResponse
     */
    public function setIconUrl(string $iconUrl): UnitCommandResponse
    {
        $this->iconUrl = $iconUrl;
        return $this;
    }

    /**
     * @return int
     */
    public function getCommandCount(): int
    {
        return $this->commandCount;
    }

    /**
     * @param int $commandCount
     * @return UnitCommandResponse
     */
    public function setCommandCount(int $commandCount): UnitCommandResponse
    {
        $this->commandCount = $commandCount;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @param string $endDate
     * @return UnitCommandResponse
     */
    public function setEndDate(string $endDate): UnitCommandResponse
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getRemainingTime(): string
    {
        return $this->remainingTime;
    }

    /**
     * @param string $remainingTime
     * @return UnitCommandResponse
     */
    public function setRemainingTime(string $remainingTime): UnitCommandResponse
    {
        $this->remainingTime = $remainingTime;
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
     * @return UnitCommandResponse
     */
    public function setCosts(CostResponse $costs): UnitCommandResponse
    {
        $this->costs = $costs;
        return $this;
    }
}