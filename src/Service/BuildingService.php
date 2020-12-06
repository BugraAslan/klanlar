<?php

namespace App\Service;

use App\Entity\Building;
use App\Repository\BuildingCommandRepository;

class BuildingService extends BaseService
{
    /** @var BuildingCommandRepository */
    private $buildingRepository;

    /**
     * BuildingService constructor.
     * @param BuildingCommandRepository $buildingRepository
     */
    public function __construct(BuildingCommandRepository $buildingRepository)
    {
        $this->buildingRepository = $buildingRepository;
    }

    /**
     * @param int $buildingId
     * @param int $cacheLifeTime
     * @return Building|null
     */
    public function getBuildingById(int $buildingId, int $cacheLifeTime = 0)
    {
        return $this->buildingRepository->findBuildingById($buildingId, $cacheLifeTime);
    }
}