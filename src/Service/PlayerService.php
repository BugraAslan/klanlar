<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerWorld;
use App\Entity\World;
use App\Repository\PlayerRepository;

class PlayerService extends BaseService
{
    /** @var PlayerRepository */
    private $playerRepository;

    /**
     * PlayerService constructor.
     * @param PlayerRepository $playerRepository
     */
    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function checkUniqueUsername(string $username): bool
    {
        return (bool)$this->playerRepository->findPlayerCountByUsername($username);
    }

    public function checkUniqueEmail(string $email): bool
    {
        return (bool)$this->playerRepository->findPlayerCountByEmail($email);
    }

    public function getPlayerWorldByPlayerId(int $playerId): ?Player
    {
        return $this->playerRepository->findPlayerWorldByPlayerId($playerId);
    }

    public function getPlayerWorld(Player $player)
    {
        $excludeWorldIds = [];
        foreach ($this->getPlayerWorldByPlayerId($player->getId())->getWorlds() as $playerWorld) {
            $excludeWorldIds[] = $playerWorld->getWorld()->getId();
        }

        return $this->entityManager->getRepository(World::class)
            ->findActiveWorldByExcludeIds($excludeWorldIds);
    }

    public function hasPlayingInWorld(Player $player): bool
    {
        return (bool)$this->entityManager->getRepository(PlayerWorld::class)->count([
            'player' => $player->getId(),
            'world' => $player->getWorldId()
        ]);
    }

    public function getPlayerProfile()
    {

    }
}