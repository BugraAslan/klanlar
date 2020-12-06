<?php

namespace App\Service\Building;

use App\Entity\BuildingCommand;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\BuildingRequirementResponse;
use App\Model\Response\Building\MainBuildingDetailResponse;
use App\Model\Response\CostResponse;
use App\Strategy\BuildingStrategyInterface;
use Doctrine\Common\Collections\ArrayCollection;

class MainBuildingService extends AbstractBaseBuildingService implements BuildingStrategyInterface
{
    public const BUILDING_NAME = 'Ana Bina';

    public function canHandle(string $buildingName): bool
    {
        return self::BUILDING_NAME === $buildingName;
    }

    public function buildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        $villageBuildingDetails = $this->villageBuildingRepository->findBuildingDetailByVillageId(
            $buildingDetailRequest->getVillageId()
        );

        if (empty($villageBuildingDetails)){
            return null;
        }

        $buildingDetail = $this->villageBuildingRepository->findBuildingDetailById(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $buildingDetail,
            new MainBuildingDetailResponse()
        );

        $buildingRequirementCollection = new ArrayCollection();
        foreach ($villageBuildingDetails as $villageBuilding) {
            $resource = $villageBuilding->getVillage()->getResource();
            $building = $villageBuilding->getBuilding();
            $nextBuildingLevel = ($villageBuilding->getBuildingLevel() + 1);

            $woodCost = $building->getWoodCost() * ($nextBuildingLevel * $building->getWoodFactor());
            $clayCost = $building->getClayCost() * ($nextBuildingLevel * $building->getClayFactor());
            $ironCost = $building->getIronCost() * ($nextBuildingLevel * $building->getIronFactor());
            $populationCost = $building->getPopulationCost() * ($nextBuildingLevel * $building->getPopulationFactor());

            $buildable = true;
            $buildableMessage = null;
            $resourceCost = ['Wood' => $woodCost, 'Clay' => $clayCost, 'Iron' => $ironCost];
            $maxResourceCost = array_search(max($resourceCost), $resourceCost);
            $resourceGetter = 'get'.$maxResourceCost;

            if ($resource->getWarehouse() < max($resourceCost)) {
                $buildableMessage = 'Yetersiz depo';
                $buildable = false;
            }

            if ($buildable && $populationCost > $resource->getPopulation()) {
                $buildableMessage = 'Yetersiz işçi';
                $buildable = false;
            }

            if ($buildable && $resource->$resourceGetter() < $resourceCost[$maxResourceCost]) {
                $buildableMessage = 'Yetersiz kaynak';
                $buildable = false;
            }

            $buildingRequirementResponse = (new BuildingRequirementResponse())
                ->setId($building->getId())
                ->setName($building->getName())
                ->setCurrentLevel($villageBuilding->getBuildingLevel())
                ->setBuildLevel($nextBuildingLevel)
                ->setIconUrl($building->getIcons()->getBaseIcon())
                ->setBuildTime((
                        $building->getBaseBuildTime() * ($building->getTimeFactor() * $nextBuildingLevel)
                    ) / 60
                )
                ->setBuildableTime('') // TODO math process
                ->setHasMaxLevel($villageBuilding->getBuildingLevel() === $building->getMaxLevel())
                ->setIsBuildable($buildable)
                ->setBuildableMessage($buildableMessage)
                ->setCosts(
                    (new CostResponse())
                        ->setPopulation($populationCost)
                        ->setIron($ironCost)
                        ->setClay($clayCost)
                        ->setWood($woodCost)
                );

            $buildingRequirementCollection->add($buildingRequirementResponse);
        }

        $buildingCommands = $this->entityManager->getRepository(BuildingCommand::class)
            ->findBuildingCommandsByVillageId($buildingDetailRequest->getVillageId());

        return $buildingDetailResponse
            ->setBuildingCommands(
                $this->buildingDetailResponseManager->buildBuildingCommandResponseCollection($buildingCommands)
            )
            ->setBuildingRequirements($buildingRequirementCollection->toArray());
    }
}