<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerToken;
use App\Model\Request\Login\LoginRequest;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;

class LoginService extends BaseService
{
    /**
     * @param LoginRequest $loginRequest
     * @return PlayerToken|null
     */
    public function login(LoginRequest $loginRequest)
    {
        $player = $this->entityManager->getRepository(Player::class)->findOneBy([
            'username' => $loginRequest->getUsername(),
            'password' => $loginRequest->getPassword()
        ]);

        $playerToken = null;
        if ($player instanceof Player){
            try {
                $token = (new UriSafeTokenGenerator())->generateToken();
                $player->setToken($token);
                $playerToken = (new PlayerToken())
                    ->setAccessToken($token)
                    ->setPlayer($player)
                    ->setExpireDate((new \DateTime())->modify('+30 minutes'));

                $this->entityManager->persist($playerToken);
                $this->entityManager->flush($playerToken);
            } catch (ORMException $e) {
                return null;
            }
        }

        return $playerToken;
    }
}