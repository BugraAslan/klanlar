<?php

namespace App\Model\Response\Building;

use App\Model\Response\BaseCommandResponse;

class BuildingCommandResponse extends BaseCommandResponse
{
    /** @var int */
    protected $buildLevel;

    /**
     * @return int
     */
    public function getBuildLevel(): int
    {
        return $this->buildLevel;
    }

    /**
     * @param int $buildLevel
     * @return BuildingCommandResponse
     */
    public function setBuildLevel(int $buildLevel): BuildingCommandResponse
    {
        $this->buildLevel = $buildLevel;
        return $this;
    }
}