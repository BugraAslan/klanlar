<?php

namespace App\Model\Response\Unit;

use App\Model\Response\BaseCommandResponse;

class UnitCommandResponse extends BaseCommandResponse
{
    /** @var int */
    protected $commandCount;

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
}