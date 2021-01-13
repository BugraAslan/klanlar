<?php

namespace App\Service\Building;

use App\Manager\Response\BuildingDetailResponseManager;
use App\Manager\Response\CommandResponseManager;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\ResourceManufacturerBuildingDetailResponse;
use App\Model\Response\Building\UnitManufacturerBuildingDetailResponse;
use App\Model\Response\Unit\UnitRequirementResponse;
use App\Repository\VillageBuildingRepository;
use App\Service\BaseService;
use App\Util\BuildingUtil;
use App\Util\VillageUtil;
use Doctrine\Common\Collections\ArrayCollection;

abstract class AbstractBaseBuildingService extends BaseService
{
    /** @var VillageBuildingRepository */
    protected $villageBuildingRepository;

    /** @var BuildingDetailResponseManager */
    protected $buildingDetailResponseManager;

    /** @var CommandResponseManager */
    protected $commandResponseManager;

    /**
     * AbstractBaseBuildingService constructor.
     * @param VillageBuildingRepository $villageBuildingRepository
     * @param BuildingDetailResponseManager $buildingDetailResponseManager
     * @param CommandResponseManager $commandResponseManager
     */
    public function __construct(
        VillageBuildingRepository $villageBuildingRepository,
        BuildingDetailResponseManager $buildingDetailResponseManager,
        CommandResponseManager $commandResponseManager
    ) {
        $this->villageBuildingRepository = $villageBuildingRepository;
        $this->buildingDetailResponseManager = $buildingDetailResponseManager;
        $this->commandResponseManager = $commandResponseManager;
    }

    /**
     * @param BuildingDetailRequest $buildingDetailRequest
     * @return UnitManufacturerBuildingDetailResponse|null
     */
    protected function getUnitManufacturerBuildingDetail(BuildingDetailRequest $buildingDetailRequest): ?UnitManufacturerBuildingDetailResponse
    {
        // TODO founder unit control !!!
        $villageBuilding = $this->villageBuildingRepository->findUnitManufacturerBuildingDetail(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if (!$villageBuilding) {
            return null;
        }

        $buildingDetailResponse = $this->buildingDetailResponseManager->buildBuildingDetailResponse(
            $villageBuilding,
            new UnitManufacturerBuildingDetailResponse()
        );

        $village = $villageBuilding->getVillage();
        $unitRequirementResponseCollection = new ArrayCollection();
        $unitCommandResponseCollection = new ArrayCollection();
        foreach ($villageBuilding->getBuilding()->getUnitManufacturers() as $unitManufacturer) {
            $unit = $unitManufacturer->getUnit();
            foreach ($unit->getCommands() as $unitCommand) {
                $unitCommandResponseCollection->add(
                    $this->commandResponseManager->buildUnitCommandResponse($unitCommand, $unit)
                );
            }

            $unitRequirementResponse = (new UnitRequirementResponse())
                ->setId($unit->getId())
                ->setName($unit->getName())
                ->setIconUrl($unit->getIcons()->getOverviewIcon())
                ->setCosts($this->buildingDetailResponseManager->buildUnitCostResponse($unit))
                ->setBuildCount(
                    min([
                        ceil($village->getWood() / $unit->getCostPerWood()),
                        ceil($village->getClay() / $unit->getCostPerClay()),
                        ceil($village->getIron() / $unit->getCostPerIron())
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
        $villageBuilding = $this->villageBuildingRepository->findOneBuildingDetailById(
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
        $hasMaxLevel = $villageBuilding->getBuildingLevel() === $building->getMaxLevel();
        if ($building->getId() == BuildingUtil::WALL_ID) {
            $currentOutput = $villageBuilding->getBuildingLevel() * $building->getOutputFactor();
            $nexManufactureCount = $hasMaxLevel ? 0 : $currentOutput + $building->getOutputFactor();
        } else {
            $currentOutput = VillageUtil::costCalculator(
                $building->getBaseOutput(),
                $building->getOutputFactor(),
                in_array($building->getId(), [BuildingUtil::WAREHOUSE_ID, BuildingUtil::FARM_ID]) ?
                    ($villageBuilding->getBuildingLevel() - 1) : $villageBuilding->getBuildingLevel()
            );
            $nexManufactureCount = $hasMaxLevel ? 0 : $currentOutput * $building->getOutputFactor();
        }

        return $buildingDetailResponse
            ->setCurrentManufactureCount(ceil($currentOutput))
            ->setNextManufactureCount(ceil($nexManufactureCount))
            ->setResourceEffects([])
            ->setHasMaxLevel($hasMaxLevel);
    }
}