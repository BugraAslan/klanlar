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

        $buildingDetail = $this->villageBuildingRepository->findOneBuildingDetailById(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $buildingDetail,
            new MainBuildingDetailResponse()
        );

        // TODO to be include buildable buildings requirements
        $buildingRequirementCollection = new ArrayCollection();
        foreach ($villageBuildingDetails as $villageBuilding) {
            $building = $villageBuilding->getBuilding();
            $currentBuildingLevel = $villageBuilding->getBuildingLevel();
            $village = $villageBuilding->getVillage();

            $woodCost = $this->costCalculator($building->getWoodCost(), $building->getWoodFactor(), $currentBuildingLevel);
            $clayCost = $this->costCalculator($building->getClayCost(), $building->getClayFactor(), $currentBuildingLevel);
            $ironCost = $this->costCalculator($building->getIronCost(), $building->getIronFactor(), $currentBuildingLevel);
            $totalPopulationCost = $this->costCalculator($building->getPopulationCost(), $building->getPopulationFactor(), $currentBuildingLevel);
            $populationCost = $totalPopulationCost - ceil($totalPopulationCost / $building->getPopulationFactor());

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

            // TODO change
            $buildTime = $this->costCalculator($building->getBaseBuildTime(), $building->getTimeFactor(), $currentBuildingLevel);
            $buildTime = $buildTime > 60 ? ceil($buildTime / 60) : $buildTime;

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

        $buildingCommands = $this->entityManager->getRepository(BuildingCommand::class)
            ->findBuildingCommandsByVillageId($buildingDetailRequest->getVillageId());

        return $buildingDetailResponse
            ->setBuildingCommands(
                $this->buildingDetailResponseManager->buildBuildingCommandResponseCollection($buildingCommands)
            )
            ->setBuildingRequirements($buildingRequirementCollection->toArray());
    }
}