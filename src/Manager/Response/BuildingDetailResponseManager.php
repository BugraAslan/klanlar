<?php

namespace App\Manager\Response;

use App\Entity\BuildingCommand;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Entity\VillageBuilding;
use App\Model\Response\Building\BaseBuildingDetailResponse;
use App\Model\Response\Building\BuildingCommandResponse;
use App\Model\Response\CostResponse;
use Doctrine\Common\Collections\ArrayCollection;

class BuildingDetailResponseManager
{
    public function buildBuildingDetailResponse(VillageBuilding $villageBuilding, $response = null)
    {
        if (!$response){
            $response = new BaseBuildingDetailResponse();
        }

        return $response
            ->setId($villageBuilding->getBuilding()->getId())
            ->setName($villageBuilding->getBuilding()->getName())
            ->setDescription($villageBuilding->getBuilding()->getBuildingDescription()->getDescription())
            ->setIconUrl($villageBuilding->getBuilding()->getIcons()->getBaseIcon());
    }

    /**
     * @param UnitCommand|BuildingCommand|Unit $entity
     * @return CostResponse|null
     */
    public function buildCostResponse($entity): ?CostResponse
    {
        $costResponse = null;
        if ($entity instanceof UnitCommand || $entity instanceof BuildingCommand) {
            $costResponse = (new CostResponse())
                ->setWood($entity->getCostWood())
                ->setClay($entity->getCostClay())
                ->setIron($entity->getCostIron())
                ->setPopulation($entity->getCostPopulation());
        } else if ($entity instanceof Unit){
            $costResponse = (new CostResponse())
                ->setWood($entity->getCostPerWood())
                ->setClay($entity->getCostPerClay())
                ->setIron($entity->getCostPerIron())
                ->setPopulation($entity->getCostPerPopulation());
        }

        return $costResponse;
    }

    /**
     * @param BuildingCommand[] $buildingCommands
     * @return array
     */
    public function buildBuildingCommandResponseCollection(array $buildingCommands): array
    {
        $buildingCommandCollection = new ArrayCollection();
        foreach ($buildingCommands as $buildingCommand) {
            $buildingCommandCollection->add(
                (new BuildingCommandResponse())
                    ->setIconUrl($buildingCommand->getBuilding()->getIcons()->getBaseIcon())
                    ->setRemainingTime(($buildingCommand->getEndDate()->diff(new \DateTime()))->format('%h:%i:%s'))
                    ->setEndDate($buildingCommand->getEndDate()->format('Y-m-d H:i:s'))
                    ->setName($buildingCommand->getBuilding()->getName())
                    ->setCosts($this->buildCostResponse($buildingCommand))
            );
        }

        return $buildingCommandCollection->toArray();
    }
}