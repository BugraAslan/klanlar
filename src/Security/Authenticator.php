<?php

namespace App\Security;

use App\Entity\PlayerToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class Authenticator extends AbstractLoginFormAuthenticator
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

    protected function getLoginUrl(Request $request): string
    {
        return 'login';
    }

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function authenticate(Request $request): PassportInterface
    {
        $token = $request->headers->get('X-AUTH-TOKEN');
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        $playerToken = $this->entityManager->getRepository(PlayerToken::class)->findOneBy([
            'accessToken' => $token
        ]);

        if (!$playerToken) {
            throw new UsernameNotFoundException();
        }

        return new SelfValidatingPassport($playerToken->getPlayer());
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }
}