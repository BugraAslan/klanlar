<?php

namespace App\Manager\Response;

use App\Entity\Building;
use App\Entity\BuildingCommand;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Model\Response\PostCommandResponse;
use App\Model\Response\Building\BuildingCommandResponse;
use App\Model\Response\Unit\UnitCommandResponse;

class CommandResponseManager
{
    use CostResponseManagerTrait;

    public function buildUnitCommandResponse(UnitCommand $unitCommand, ?Unit $unit = null): UnitCommandResponse
    {
        $unitCommandResponse = (new UnitCommandResponse())
            ->setCommandId($unitCommand->getId())
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

    public function buildBuildingCommandResponse(BuildingCommand $buildingCommand, ?Building $building = null): BuildingCommandResponse
    {
        $buildingCommandResponse = (new BuildingCommandResponse())
            ->setCommandId($buildingCommand->getId())
            ->setRemainingTime(($buildingCommand->getEndDate()->diff(new \DateTime()))->format('%a/%h:%i:%s'))
            ->setEndDate($buildingCommand->getEndDate()->format('Y-m-d H:i:s'))
            ->setBuildLevel($buildingCommand->getBuildLevel())
            ->setCosts($this->buildCommandCostResponse($buildingCommand));

        if ($building instanceof Building) {
            $buildingCommandResponse
                ->setName($building->getName())
                ->setIconUrl($building->getIcons()->getBaseIcon());
        }

        return $buildingCommandResponse;
    }

    /**
     * @param BuildingCommand|UnitCommand $commandEntity
     * @return PostCommandResponse
     */
    public function buildPostCommandResponse($commandEntity): PostCommandResponse
    {
        return (new PostCommandResponse())
            ->setCommandId($commandEntity->getId())
            ->setStartDate($commandEntity->getStartDate()->format('Y-m-d H:i:s'))
            ->setEndDate($commandEntity->getEndDate()->format('Y-m-d H:i:s'));
    }
}