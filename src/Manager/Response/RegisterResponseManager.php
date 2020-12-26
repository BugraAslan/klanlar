<?php

namespace App\Manager\Response;

use App\Entity\Player;
use App\Model\Response\Register\RegisterResponse;

class RegisterResponseManager
{
    public function buildRegisterResponse(Player $player): RegisterResponse
    {
        return (new RegisterResponse())
            ->setActivationCode($player->getActivation()->getActivationCode())
            ->setUsername($player->getUsername())
            ->setId($player->getId());
    }
}