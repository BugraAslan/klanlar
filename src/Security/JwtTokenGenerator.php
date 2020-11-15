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

    public function generateToken()
    {
        return JWT::encode([
            'expireTime' => (new \DateTime())
                ->modify($this->container->getParameter('default_expire_time'))
                ->getTimestamp()
        ],
        $this->container->getParameter('app_secret'),
        'HS256'
        );
    }

    public function generateRefreshToken(int $playerId)
    {
        return hash_hmac(
            'SHA256',
            $playerId . microtime(true) . rand(1, 10000),
            $this->container->getParameter('app_secret')
        );
    }
}