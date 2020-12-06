<?php

namespace App\Model\Response;

class BaseCommandResponse
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $iconUrl;

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
     * @return BaseCommandResponse
     */
    public function setName(string $name): BaseCommandResponse
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
     * @return BaseCommandResponse
     */
    public function setIconUrl(string $iconUrl): BaseCommandResponse
    {
        $this->iconUrl = $iconUrl;
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
     * @return BaseCommandResponse
     */
    public function setEndDate(string $endDate): BaseCommandResponse
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
     * @return BaseCommandResponse
     */
    public function setRemainingTime(string $remainingTime): BaseCommandResponse
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
     * @return BaseCommandResponse
     */
    public function setCosts(CostResponse $costs): BaseCommandResponse
    {
        $this->costs = $costs;
        return $this;
    }
}