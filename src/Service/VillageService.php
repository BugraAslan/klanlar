<?php

namespace App\Service;

use App\Entity\Player;
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
     * @param int $worldId
     * @param int $villageId
     * @return PlayerVillage|null
     */
    public function getVillageInfoById(int $playerId, int $worldId, int $villageId): ?PlayerVillage
    {
        return $this->playerVillageRepository->findVillageInfoById($playerId, $worldId, $villageId);
    }

    public function getPlayerVillageCountByWorld(Player $player): int
    {
        return $this->playerVillageRepository->count([
            'player' => $player->getId(),
            'worldId' => $player->getWorldId()
        ]);
    }

    public function getPlayerVillageByWorld(Player $player): array
    {
        return $this->playerVillageRepository->findBy([
            'player' => $player->getId(),
            'worldId' => $player->getWorldId()
        ]);
    }
}