<?php

namespace App\Service\Building;

use App\Manager\Response\BuildingDetailResponseManager;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\ResourceManufacturerBuildingDetailResponse;
use App\Model\Response\Building\UnitManufacturerBuildingDetailResponse;
use App\Model\Response\Unit\UnitCommandResponse;
use App\Model\Response\Unit\UnitRequirementResponse;
use App\Repository\VillageBuildingRepository;
use App\Service\BaseService;
use App\Util\BuildingUtil;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractBaseBuildingService extends BaseService
{
    /** @var VillageBuildingRepository */
    protected $villageBuildingRepository;

    /** @var BuildingDetailResponseManager */
    protected $buildingDetailResponseManager;

    /**
     * AbstractBaseBuildingService constructor.
     * @param VillageBuildingRepository $villageBuildingRepository
     * @param BuildingDetailResponseManager $buildingDetailResponseManager
     */
    public function __construct(
        VillageBuildingRepository $villageBuildingRepository,
        BuildingDetailResponseManager $buildingDetailResponseManager
    ) {
        $this->villageBuildingRepository = $villageBuildingRepository;
        $this->buildingDetailResponseManager = $buildingDetailResponseManager;
    }

    /**
     * @param BuildingDetailRequest $buildingDetailRequest
     * @return UnitManufacturerBuildingDetailResponse|null
     */
    protected function getUnitManufacturerBuildingDetail(BuildingDetailRequest $buildingDetailRequest): ?UnitManufacturerBuildingDetailResponse
    {
        $villageBuilding = $this->villageBuildingRepository->findUnitManufacturerBuildingDetail(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if (!$villageBuilding){
            return null;
        }

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $villageBuilding,
            new UnitManufacturerBuildingDetailResponse()
        );

        $resource = $villageBuilding->getVillage()->getResource();
        $unitRequirementResponseCollection = new ArrayCollection();
        $unitCommandResponseCollection = new ArrayCollection();
        foreach ($villageBuilding->getBuilding()->getUnitManufacturers() as $unitManufacturer) {
            $unit = $unitManufacturer->getUnit();
            foreach ($unit->getCommands() as $unitCommand) {
                $unitCommandResponseCollection->add(
                    (new UnitCommandResponse())
                        ->setName($unit->getName())
                        ->setIconUrl('url')
                        ->setRemainingTime(($unitCommand->getEndDate()->diff(new \DateTime()))->format('%h:%i:%s'))
                        ->setEndDate($unitCommand->getEndDate()->format('Y-m-d H:i:s'))
                        ->setCommandCount($unitCommand->getCommandCount())
                        ->setCosts($this->buildingDetailResponseManager->buildCostResponse($unitCommand))
                );
            }

            $unitRequirementResponse = (new UnitRequirementResponse())
                ->setId($unit->getId())
                ->setName($unit->getName())
                ->setIconUrl($unit->getIcons()->getOverviewIcon())
                ->setCosts($this->buildingDetailResponseManager->buildCostResponse($unit))
                ->setBuildCount(
                    min([
                        ceil($resource->getWood() / $unit->getCostPerWood()),
                        ceil($resource->getClay() / $unit->getCostPerClay()),
                        ceil($resource->getIron() / $unit->getCostPerIron())
                    ])
                )
                ->setBuildTime($unit->getBaseBuildTime() / 60)
                ->setExistingCount(0);

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

    protected function getResourceManufacturerBuildingDetail(BuildingDetailRequest $buildingDetailRequest): ?ResourceManufacturerBuildingDetailResponse
    {
        $villageBuilding = $this->villageBuildingRepository->findResourceManufacturerBuildingDetail(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if (!$villageBuilding) {
            return null;
        }

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $villageBuilding,
            new ResourceManufacturerBuildingDetailResponse()
        );

        $building = $villageBuilding->getBuilding();
        $buildingOutput = $building->getBuildingOutput();
        $hasMaxLevel = $villageBuilding->getBuildingLevel() === $building->getMaxLevel();
        if ($building->getId() == BuildingUtil::WALL_ID) {
            $currentOutput = $villageBuilding->getBuildingLevel() * $buildingOutput->getOutputFactor();
            $nexManufactureCount = $hasMaxLevel ? 0 : $currentOutput + $buildingOutput->getOutputFactor();
        } else {
            $currentOutput = $this->costCalculator(
                $buildingOutput->getBaseOutput(),
                $buildingOutput->getOutputFactor(),
                in_array($building->getId(), [BuildingUtil::WAREHOUSE_ID, BuildingUtil::FARM_ID]) ?
                    ($villageBuilding->getBuildingLevel() - 1) : $villageBuilding->getBuildingLevel()
            );
            $nexManufactureCount = $hasMaxLevel ? 0 : $currentOutput * $buildingOutput->getOutputFactor();
        }

        return $buildingDetailResponse
            ->setCurrentManufactureCount(ceil($currentOutput))
            ->setNextManufactureCount(ceil($nexManufactureCount))
            ->setResourceEffects([])
            ->setHasMaxLevel($hasMaxLevel);
    }

    protected function costCalculator(int $costPerItem, float $costFactor, int $itemLevel)
    {
        return ceil($costPerItem * pow($costFactor, $itemLevel));
    }
}