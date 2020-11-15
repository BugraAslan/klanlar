<?php

namespace App\Controller;

use App\Service\PlayerService;

class PlayerController extends BaseController
{
    /** @var PlayerService */
    private $playerService;

    /**
     * PlayerController constructor.
     * @param PlayerService $playerService
     */
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function playerInfo()
    {
        return $this->successResponse([]);
    }
}