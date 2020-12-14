<?php

namespace App\Service;

use App\Repository\WorldRepository;

class WorldService extends BaseService
{
    /** @var WorldRepository */
    private $worldRepository;

    /**
     * WorldService constructor.
     * @param WorldRepository $worldRepository
     */
    public function __construct(WorldRepository $worldRepository)
    {
        $this->worldRepository = $worldRepository;
    }

    public function getActiveWorlds(): array
    {
        return $this->worldRepository->findBy(['status' => true]);
    }
}