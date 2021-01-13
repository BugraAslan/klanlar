<?php

namespace App\Manager\Response;

use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Model\Response\Unit\UnitCommandResponse;

class CommandResponseManager
{
    use CostResponseManagerTrait;

    public function buildUnitCommandResponse(UnitCommand $unitCommand, ?Unit $unit = null): UnitCommandResponse
    {
        $unitCommandResponse = (new UnitCommandResponse())
            ->setRemainingTime(($unitCommand->getEndDate()->diff(new \DateTime()))->format('%a/%h:%i:%s'))
            ->setEndDate($unitCommand->getEndDate()->format('Y-m-d H:i:s'))
            ->setCommandCount($unitCommand->getCommandCount())
            ->setCosts($this->buildCommandCostResponse($unitCommand));

        if ($unit instanceof Unit) {
            $unitCommandResponse
                ->setName($unit->getName())
                ->setIconUrl($unit->getIcons()->getOverviewIcon());
        }

        return $unitCommandResponse;
    }
}