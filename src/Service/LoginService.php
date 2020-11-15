<?php

namespace App\Service;

use App\Entity\Player;
use App\Entity\PlayerToken;
use App\Model\Request\Login\LoginRequest;
use App\Security\JwtTokenGenerator;
use Doctrine\ORM\ORMException;

class LoginService extends BaseService
{
    /** @var JwtTokenGenerator */
    private $jwtTokenGenerator;

    /**
     * LoginService constructor.
     * @param JwtTokenGenerator $jwtTokenGenerator
     */
    public function __construct(JwtTokenGenerator $jwtTokenGenerator)
    {
        $this->jwtTokenGenerator = $jwtTokenGenerator;
    }

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

            $accessToken = $this->jwtTokenGenerator->generateToken();
            $refreshToken = $this->jwtTokenGenerator->generateRefreshToken($player->getId());
            $player->setApiToken($accessToken);
            $expireDate = (new \DateTime())->modify($this->container->getParameter('default_expire_time'));

            if ($playerToken instanceof PlayerToken){
                $player->setApiToken($accessToken);
                $playerToken
                    ->setAccessToken($accessToken)
                    ->setRefreshToken($refreshToken)
                    ->setExpireDate($expireDate);
            } else {
                $playerToken = (new PlayerToken())
                    ->setAccessToken($accessToken)
                    ->setRefreshToken($refreshToken)
                    ->setPlayer($player)
                    ->setExpireDate($expireDate);
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