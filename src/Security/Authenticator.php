<?php

namespace App\Security;

use App\Entity\Player;
use App\Entity\PlayerToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class Authenticator extends AbstractAuthenticator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * Authenticator constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(Request $request): ?bool
    {
        return strpos($request->getRequestUri(), '/api/public') === false;
    }

    public function authenticate(Request $request): PassportInterface
    {
        $token = $request->headers->get('Token');
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        $playerToken = $this->entityManager->getRepository(PlayerToken::class)
            ->findActivePlayerToken($token);

        if (!$playerToken instanceof PlayerToken) {
            throw new AuthenticationException();
        }

        /** @var Player $player */
        $player = $playerToken->getPlayer();
        $player->setToken($token);

        return new Passport($player, new CustomCredentials(
            function ($credentials, UserInterface $player) {
                return $player->getToken() === $credentials;
            },
            $token
        ));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'success' => false,
            'error' => 'Authentication Failed'
        ], Response::HTTP_UNAUTHORIZED);
    }
}