<?php

namespace App\Service;

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

    /**
     * @param string $username
     * @return bool
     */
    public function checkUniqueUsername(string $username)
    {
        return (bool)$this->playerRepository->findPlayerCountByUsername($username);
    }

    /**
     * @param string $email
     * @return bool
     */
    public function checkUniqueEmail(string $email)
    {
        return (bool)$this->playerRepository->findPlayerCountByEmail($email);
    }
}