<?php

namespace App\Strategy;

use App\Entity\VillageBuilding;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Repository\VillageBuildingRepository;

class BuildingStrategy
{
    /** @var BuildingStrategyInterface[] */
    public $buildingStrategies = [];

    /** @var VillageBuildingRepository */
    private $villageBuildingRepository;

    /**
     * BuildingStrategy constructor.
     * @param VillageBuildingRepository $villageBuildingRepository
     */
    public function __construct(VillageBuildingRepository $villageBuildingRepository)
    {
        $this->villageBuildingRepository = $villageBuildingRepository;
    }

    public function addBuildingStrategy(BuildingStrategyInterface $buildingStrategy)
    {
        $this->buildingStrategies[] = $buildingStrategy;
    }

    /**
     * @param BuildingDetailRequest $buildingDetailRequest
     * @return VillageBuilding|null
     */
    public function getBuildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        $buildingDetail = $this->villageBuildingRepository->findBuildingDetail(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if ($buildingDetail){
            foreach ($this->buildingStrategies as $buildingStrategy){
                if ($buildingStrategy->canHandle($buildingDetail->getBuilding()->getName())) {
                    $buildingDetail = $buildingStrategy->buildingDetail($buildingDetail);
                    break;
                }
            }
        }

        return $buildingDetail;
    }
}