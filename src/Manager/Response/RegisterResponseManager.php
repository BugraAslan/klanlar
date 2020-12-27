<?php

namespace App\Manager\Response;

use App\Entity\PlayerActivation;
use App\Model\Response\Register\RegisterResponse;

class RegisterResponseManager
{
    public function buildRegisterResponse(PlayerActivation $playerActivation): RegisterResponse
    {
        return (new RegisterResponse())
            ->setId($playerActivation->getPlayer()->getId())
            ->setUsername($playerActivation->getPlayer()->getUsername())
            ->setActivationCode($playerActivation->getActivationCode());
    }
}