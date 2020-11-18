<?php

namespace App\Strategy;

use App\Entity\Building;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Service\BuildingService;

class BuildingStrategy
{
    /** @var BuildingStrategyInterface[] */
    public $buildingStrategies = [];

    /** @var BuildingService */
    private $buildingService;

    /**
     * Building constructor.
     * @param BuildingService $buildingService
     */
    public function __construct(BuildingService $buildingService)
    {
        $this->buildingService = $buildingService;
    }

    public function addBuildingStrategy(BuildingStrategyInterface $buildingStrategy)
    {
        $this->buildingStrategies[] = $buildingStrategy;
    }

    public function getBuildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        $buildingEntity = $this->buildingService->getBuildingById(
            $buildingDetailRequest->getBuildingId(),
            7200
        );

        if ($buildingEntity instanceof Building){
            foreach ($this->buildingStrategies as $buildingStrategy){
                if ($buildingStrategy->canHandle($buildingEntity->getName())) {
                    return $buildingStrategy->buildingDetail($buildingDetailRequest);
                }
            }
        }

        return false;
    }
}