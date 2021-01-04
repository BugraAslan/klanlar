<?php

namespace App\Strategy;

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

    public function getBuildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        $buildingName = $this->villageBuildingRepository->findBuildingNameById(
            $buildingDetailRequest->getVillageId(),
            $buildingDetailRequest->getBuildingId()
        );

        if ($buildingName) {
            foreach ($this->buildingStrategies as $buildingStrategy) {
                if ($buildingStrategy->canHandle($buildingName)) {
                    return $buildingStrategy->buildingDetail($buildingDetailRequest);
                }
            }
        }

        return null;
    }
}