<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\World;
use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;

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

    public function getWorldLogin(int $playerId): ArrayCollection
    {
        $player = $this->getPlayerWorldByPlayerId($playerId);
        $excludeWorldIds = [];
        foreach ($player->getWorlds()->toArray() as $world) {
            $excludeWorldIds[] = $world->getId();
        }

        $worldLoginCollection = new ArrayCollection();
        $worldLoginCollection->set('player', $player);
        $worldLoginCollection->set(
            'availableWorlds',
            $this->entityManager->getRepository(World::class)->findActiveWorldByExcludeIds($excludeWorldIds)
        );

        return $worldLoginCollection;
    }
}