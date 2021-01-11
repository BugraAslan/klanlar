<?php

namespace App\Security;

use Firebase\JWT\JWT;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class JwtTokenGenerator implements TokenGeneratorInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * JwtTokenGenerator constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function generateToken(int $worldId = 0): string
    {
        $parameters = [
            'expireTime' => (new \DateTime())
                ->modify($this->container->getParameter('default_expire_time'))
                ->getTimestamp()
        ];

        if ($worldId) {
            $parameters['worldId'] = $worldId;
        }

        return JWT::encode($parameters, $this->container->getParameter('app_secret'));
    }

    public function generateRefreshToken(int $playerId): string
    {
        return hash_hmac(
            'SHA256',
            $playerId . microtime(true) . rand(1, 10000),
            $this->container->getParameter('app_secret')
        );
    }
}