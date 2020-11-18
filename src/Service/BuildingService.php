<?php

namespace App\Service;

use App\Entity\Building;
use App\Repository\BuildingRepository;

class BuildingService extends BaseService
{
    /** @var BuildingRepository */
    private $buildingRepository;

    /**
     * BuildingService constructor.
     * @param BuildingRepository $buildingRepository
     */
    public function __construct(BuildingRepository $buildingRepository)
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