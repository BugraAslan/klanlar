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
            'password' => md5($loginRequest->getPassword())
        ]);

        $playerToken = null;
        if ($player instanceof Player){
            $playerToken = $this->entityManager->getRepository(PlayerToken::class)->findOneBy([
                'player' => $player->getId()
            ]);

            $token = (new UriSafeTokenGenerator())->generateToken();
            $tomorrowDate = (new \DateTime())->modify('+1 day');
            $player->setApiToken($token);

            if ($playerToken instanceof PlayerToken){
                $player->setApiToken($token);
                $playerToken
                    ->setRefreshToken((new UriSafeTokenGenerator())->generateToken())
                    ->setAccessToken($token)
                    ->setExpireDate($tomorrowDate);
            } else {
                $playerToken = (new PlayerToken())
                    ->setAccessToken($token)
                    ->setRefreshToken((new UriSafeTokenGenerator())->generateToken())
                    ->setPlayer($player)
                    ->setExpireDate($tomorrowDate);
            }
            try {
                $this->entityManager->persist($playerToken);
                $this->entityManager->flush($playerToken);
            } catch (ORMException $e) {
                return null;
            }
        }

        return $playerToken;
    }
}