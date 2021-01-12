<?php

namespace App\Manager\Response;

use App\Entity\BuildingCommand;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Entity\VillageBuilding;
use App\Entity\VillageUnitFounder;
use App\Model\Response\Building\BaseBuildingDetailResponseInterface;
use App\Model\Response\Building\BuildingCommandResponse;
use App\Model\Response\CostResponse;
use App\Model\Response\Unit\UnitFounderResponse;
use Doctrine\Common\Collections\ArrayCollection;

class BuildingDetailResponseManager
{
    public function buildBuildingDetailResponse(VillageBuilding $villageBuilding, BaseBuildingDetailResponseInterface $response): BaseBuildingDetailResponseInterface
    {
        $building = $villageBuilding->getBuilding();
        return $response
            ->setId($building->getId())
            ->setName($building->getName())
            ->setDescription($building->getDescription())
            ->setIconUrl($villageBuilding->getBuilding()->getIcons()->getBaseIcon())
            ->setLevel($villageBuilding->getBuildingLevel());
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

    /**
     * @param VillageUnitFounder[] $villageUnitFounders
     * @return UnitFounderResponse[]
     */
    public function buildUnitFounderResponseCollection(array $villageUnitFounders): array
    {
        $unitFounderResponseCollection = new ArrayCollection();
        foreach ($villageUnitFounders as $villageUnitFounder) {
            $unit = $villageUnitFounder->getUnit();
            $unitFounderResponseCollection->add(
                (new UnitFounderResponse())
                    ->setIsFound($villageUnitFounder->isFound())
                    ->setId($unit->getId())
                    ->setName($unit->getName())
                    ->setIconUrl($unit->getIcons()->getOverviewIcon())
                    ->setLevel($villageUnitFounder->getUnitLevel())
                    ->setCosts(
                        (new CostResponse())
                            ->setWood($unit->getCostPerWood() * 20)
                            ->setClay($unit->getCostPerClay() * 20)
                            ->setIron($unit->getCostPerIron() * 20)
                            ->setPopulation(0)
                    )
            );
        }

        return $unitFounderResponseCollection->toArray();
    }
}