<?php

namespace App\Service\Building;

use App\Manager\Response\BuildingDetailResponseManager;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Model\Response\Building\UnitManufacturerBuildingDetailResponse;
use App\Model\Response\Unit\UnitCommandResponse;
use App\Model\Response\Unit\UnitRequirementResponse;
use App\Repository\VillageBuildingRepository;
use App\Service\BaseService;
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
}