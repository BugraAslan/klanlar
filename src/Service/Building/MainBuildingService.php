<?php

namespace App\Service\Building;

use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\BuildingRequirementResponse;
use App\Model\Response\Building\MainBuildingDetailResponse;
use App\Model\Response\CostResponse;
use App\Strategy\BuildingStrategyInterface;
use App\Util\VillageUtil;
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
        $villageBuildingDetails = $this->villageBuildingRepository->findBuildingDetailWithCommandByVillageId(
            $buildingDetailRequest->getVillageId()
        );

        if (empty($villageBuildingDetails)) {
            return null;
        }

        $mainBuilding = $this->villageBuildingRepository->findOneBuildingDetailById(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $mainBuilding,
            new MainBuildingDetailResponse()
        );

        // TODO to be include buildable buildings requirements
        $buildingRequirementCollection = new ArrayCollection();
        $buildingCommandCollection = new ArrayCollection();
        $villageUtil = new VillageUtil();
        foreach ($villageBuildingDetails as $villageBuilding) {
            $building = $villageBuilding->getBuilding();
            $currentBuildingLevel = $villageBuilding->getBuildingLevel();
            $village = $villageBuilding->getVillage();
            foreach ($building->getCommands() as $buildingCommand) {
                $currentBuildingLevel++;
                $buildingCommandCollection->add(
                    $this->commandResponseManager->buildBuildingCommandResponse($buildingCommand, $building)
                );
            }

            list($woodCost, $clayCost, $ironCost, $populationCost, $buildTime) = array_values(
                $villageUtil->getBuildingCost($building, $currentBuildingLevel)
            );
            $buildable = true;
            $buildableMessage = null;
            $hasMaxLevel = $currentBuildingLevel === $building->getMaxLevel();
            if ($hasMaxLevel) {
                $buildableMessage = 'Azami bina seviyesine ulaşıldı.';
                $buildable = false;
            } else {
                $resourceCost = ['Wood' => $woodCost, 'Clay' => $clayCost, 'Iron' => $ironCost];
                $maxResourceCost = array_search(max($resourceCost), $resourceCost);
                $resourceGetter = 'get'.$maxResourceCost;

                if ($village->getWarehouse() < max($resourceCost)) {
                    $buildableMessage = 'Yetersiz depo.';
                    $buildable = false;
                }

                if ($buildable && $populationCost > $village->getPopulation()) {
                    $buildableMessage = 'Yetersiz işçi.';
                    $buildable = false;
                }

                if ($buildable && $village->$resourceGetter() < $resourceCost[$maxResourceCost]) {
                    $buildableMessage = 'Yetersiz kaynak.';
                    $buildable = false;
                }
            }

            $buildingRequirementResponse = (new BuildingRequirementResponse())
                ->setId($building->getId())
                ->setName($building->getName())
                ->setCurrentLevel($currentBuildingLevel)
                ->setBuildLevel($currentBuildingLevel + 1)
                ->setIconUrl($building->getIcons()->getBaseIcon())
                ->setBuildTime($buildTime)
                ->setBuildableTime('') // TODO change
                ->setHasMaxLevel($hasMaxLevel)
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

        return $buildingDetailResponse
            ->setBuildingCommands($buildingCommandCollection->toArray())
            ->setBuildingRequirements($buildingRequirementCollection->toArray());
    }
}