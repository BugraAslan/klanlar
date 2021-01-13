<?php

namespace App\Manager\Response;

use App\Entity\BuildingCommand;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Model\Response\CostResponse;

trait CostResponseManagerTrait
{
    /**
     * @param UnitCommand|BuildingCommand $commandEntity
     * @return CostResponse
     */
    public function buildCommandCostResponse($commandEntity): CostResponse
    {
        return (new CostResponse())
            ->setWood($commandEntity->getCostWood())
            ->setClay($commandEntity->getCostClay())
            ->setIron($commandEntity->getCostIron())
            ->setPopulation($commandEntity->getCostPopulation());
    }

    /**
     * @param Unit $unit
     * @return CostResponse
     */
    public function buildUnitCostResponse(Unit $unit): CostResponse
    {
        return $costResponse = (new CostResponse())
            ->setWood($unit->getCostPerWood())
            ->setClay($unit->getCostPerClay())
            ->setIron($unit->getCostPerIron())
            ->setPopulation($unit->getCostPerPopulation());
    }
}