<?php

namespace App\Service;

use App\Entity\Player;
use App\Model\Request\Register\RegisterRequest;

class RegisterService extends BaseService
{
    public function register(RegisterRequest $registerRequest)
    {
        $player = (new Player())
            ->setEmail($registerRequest->getEmail())
            ->setPassword($registerRequest->getPassword())
            ->setUsername($registerRequest->getUsername())
            ->setCreatedDate(new \DateTime());

        $this->entityManager->persist($player);
        $this->entityManager->flush($player);

        return $player;
    }
}