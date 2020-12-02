<?php

namespace App\Service\Building;

use App\Entity\VillageBuilding;
use App\Model\Response\Building\UnitManufacturerBuildingDetailResponse;
use App\Model\Response\CostResponse;
use App\Model\Response\Unit\UnitCommandResponse;
use App\Model\Response\Unit\UnitRequirementResponse;
use App\Service\BaseService;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractBaseBuildingService extends BaseService
{
    protected function getUnitManufacturerBuildingDetail(VillageBuilding $villageBuilding)
    {
        $buildingDetailResponse = (new UnitManufacturerBuildingDetailResponse())
            ->setId($villageBuilding->getBuilding()->getId())
            ->setName($villageBuilding->getBuilding()->getName())
            //->setDescription($villageBuilding->getBuilding()->getDescription())
            ->setDescription('desc')
            //->setIconUrl($villageBuilding->getBuilding()->getIcons()->getBaseIcon());
            ->setIconUrl('url');

        $unitRequirementResponseCollection = new ArrayCollection();
        $unitCommandResponseCollection = new ArrayCollection();
        $resource = $villageBuilding->getVillage()->getResource();

        foreach ($villageBuilding->getBuilding()->getUnitManufacturers() as $unitManufacturer) {
            $unit = $unitManufacturer->getUnit();
            foreach ($unit->getCommands() as $unitCommand){
                $commandCostResponse = (new CostResponse())
                    ->setWood($unitCommand->getCostWood())
                    ->setClay($unitCommand->getCostClay())
                    ->setIron($unitCommand->getCostIron())
                    ->setPopulation($unitCommand->getCostPopulation());

                $unitCommandResponse = (new UnitCommandResponse())
                    ->setName($unit->getName())
                    ->setIconUrl('url')
                    ->setRemainingTime($unitCommand->getRemainingTime()->format('H:i:s')) // TODO changeee!!!
                    ->setEndDate($unitCommand->getEndDate()->format('Y-m-d H:i:s'))
                    ->setCommandCount($unitCommand->getCommandCount())
                    ->setCosts($commandCostResponse);

                $unitCommandResponseCollection->add($unitCommandResponse);
            }

            $requirementCostResponse = (new CostResponse())
                ->setWood($unit->getCostPerWood())
                ->setClay($unit->getCostPerClay())
                ->setIron($unit->getCostPerIron())
                ->setPopulation($unit->getCostPerPopulation());

            $unitRequirementResponse = (new UnitRequirementResponse())
                ->setId($unit->getId())
                ->setName($unit->getName())
                //->setIconUrl($unit->getIcons()->getOverviewIcon())
                ->setIconUrl('url')
                ->setCosts($requirementCostResponse)
                ->setBuildCount(0) // TODO math process
                ->setBuildTime($unit->getBaseBuildTime() / 60)
                ->setExistingCount(0);

            // TODO existing unit count changed
            foreach ($villageBuilding->getVillage()->getVillageUnits() as $villageUnit) {
                if ($villageUnit->getUnit()->getId() == $unit->getId()) {
                    $unitRequirementResponse->setExistingCount($villageUnit->getUnitCount());
                    break;
                }
            }

            $unitRequirementResponseCollection->add($unitRequirementResponse);
        }

        return $buildingDetailResponse
            ->setUnitRequirements($unitRequirementResponseCollection->toArray())
            ->setUnitCommands($unitCommandResponseCollection->toArray());
    }

    /**
     * @param VillageBuilding $villageBuilding
     * @return bool
     */
    protected function isUnitManufacturer(VillageBuilding $villageBuilding)
    {
        return (bool)$villageBuilding->getBuilding()->getUnitManufacturers()->count();
    }
}