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
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class Authenticator extends AbstractAuthenticator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var Security */
    private $security;

    /**
     * Authenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     */
    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function supports(Request $request): ?bool
    {
        return strpos($request->attributes->get('_route'), 'public') === false;
    }

    public function authenticate(Request $request): PassportInterface
    {
        if ($this->security->getUser()){
            return new SelfValidatingPassport($this->security->getUser());
        }

        $token = $request->headers->get('Token');
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        $playerToken = $this->entityManager->getRepository(PlayerToken::class)
            ->findActivePlayerToken($token);

        if (!$playerToken instanceof PlayerToken) {
            throw new AuthenticationException();
        }

        return new SelfValidatingPassport($playerToken->getPlayer());
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'success' => false,
            'data' => null,
            'errors' => 'Authentication Failed'
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return true;
    }
}