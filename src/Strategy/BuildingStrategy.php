<?php

namespace App\Strategy;

use App\Entity\Building;
use App\Model\Request\Building\BuildingDetailRequest;
use App\Repository\VillageBuildingRepository;
use Doctrine\ORM\EntityManagerInterface;

class BuildingStrategy
{
    /** @var BuildingStrategyInterface[] */
    public $buildingStrategies = [];

    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * BuildingStrategy constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addBuildingStrategy(BuildingStrategyInterface $buildingStrategy)
    {
        $this->buildingStrategies[] = $buildingStrategy;
    }

    public function getBuildingDetail(BuildingDetailRequest $buildingDetailRequest)
    {
        $buildingName = $this->entityManager->getRepository(Building::class)->findBuildingNameById(
            $buildingDetailRequest->getBuildingId(),
            9999
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