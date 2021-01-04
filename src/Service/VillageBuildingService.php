<?php

namespace App\Service;

use App\Entity\VillageBuilding;
use App\Repository\VillageBuildingRepository;

class VillageBuildingService extends BaseService
{
    /** @var VillageBuildingRepository */
    private $villageBuildingRepository;

    /**
     * VillageBuildingService constructor.
     * @param VillageBuildingRepository $villageBuildingRepository
     */
    public function __construct(VillageBuildingRepository $villageBuildingRepository)
    {
        $this->villageBuildingRepository = $villageBuildingRepository;
    }

    /**
     * @param int $villageId
     * @param int $buildingId
     * @return VillageBuilding|null
     */
    public function getVillageBuilding(int $villageId, int $buildingId): ?VillageBuilding
    {
        return $this->villageBuildingRepository->findOneBy([
            'village' => $villageId,
            'building' => $buildingId
        ]);
    }
}