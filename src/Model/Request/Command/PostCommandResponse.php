<?php

namespace App\Model\Request\Command;

class PostCommandResponse
{
    /** @var int */
    protected $commandId;

    /** @var string */
    protected $startDate;

    /** @var string */
    protected $endDate;

    /**
     * @return int
     */
    public function getCommandId(): int
    {
        return $this->commandId;
    }

    /**
     * @param int $commandId
     * @return PostCommandResponse
     */
    public function setCommandId(int $commandId): PostCommandResponse
    {
        $this->commandId = $commandId;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     * @return PostCommandResponse
     */
    public function setStartDate(string $startDate): PostCommandResponse
    {
        $this->startDate = $startDate;
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
     * @return PostCommandResponse
     */
    public function setEndDate(string $endDate): PostCommandResponse
    {
        $this->endDate = $endDate;
        return $this;
    }
}