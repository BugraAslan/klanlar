<?php

namespace App\Service;

use App\Entity\PlayerVillage;
use App\Repository\PlayerVillageRepository;

class VillageService extends BaseService
{
    /** @var PlayerVillageRepository */
    private $playerVillageRepository;

    /**
     * VillageService constructor.
     * @param PlayerVillageRepository $playerVillageRepository
     */
    public function __construct(PlayerVillageRepository $playerVillageRepository)
    {
        $this->playerVillageRepository = $playerVillageRepository;
    }

    /**
     * @param int $playerId
     * @param int $villageId
     * @return PlayerVillage|null
     */
    public function getVillageInfoById(int $playerId, int $villageId)
    {
        return $this->playerVillageRepository->findVillageInfo($playerId, $villageId);
    }
}