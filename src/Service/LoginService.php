<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerToken;
use App\Model\Request\Login\LoginRequest;

class LoginService extends BaseService
{
    public function login(LoginRequest $loginRequest)
    {
        $player = $this->entityManager->getRepository(Player::class)->findOneBy([
            'username' => $loginRequest->getUsername(),
            'password' => $loginRequest->getPassword()
        ]);

        if ($player instanceof Player){
            $token = 'morwoss-123456';
            $player->setToken($token);
            $playerToken = (new PlayerToken())
                ->setAccessToken($token)
                ->setPlayer($player)
                ->setExpireDate((new \DateTime())->modify('+10 minutes'));
        }

        $this->entityManager->persist($playerToken);
        $this->entityManager->persist($player);
        $this->entityManager->flush();

        return $playerToken;
    }
}