<?php

namespace App\Controller;

use App\Entity\Player;

class PlayerController extends BaseController
{
    public function info()
    {
        /** @var Player $player */
        $player = $this->getUser();
        return $this->successResponse($player);
    }
}