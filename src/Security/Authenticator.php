<?php

namespace App\Security;

use App\Entity\Player;
use App\Entity\PlayerToken;
use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class Authenticator extends AbstractAuthenticator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var Security */
    private $security;

    /** @var ContainerInterface */
    private $container;

    /**
     * Authenticator constructor.
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Security $security,
        ContainerInterface $container
    ) {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->container = $container;
    }

    public function supports(Request $request): ?bool
    {
        return strpos($request->attributes->get('_route'), 'public') === false;
    }

    public function authenticate(Request $request): PassportInterface
    {
        /*if ($this->security->getUser()) {
            return new SelfValidatingPassport(
                $this->checkPlayerRoute($request, $this->security->getUser())
            );
        }*/

        $token = $request->headers->get('Token');
        if (!$token) {
            throw new AuthenticationException('Lütfen token giriniz');
        }

        try {
            $tokenData = JWT::decode($token, $this->container->getParameter('app_secret'), ['HS256']);
        } catch (\Exception $e) {
            throw new AuthenticationException('Token eşleştirilemedi, lütfen tekrar giriş yapınız');
        }

        $playerToken = $this->entityManager->getRepository(PlayerToken::class)
            ->findOneBy(['accessToken' => $token]);

        if (!$playerToken instanceof PlayerToken) {
            throw new AuthenticationException('Token bulunamadı, lütfen doğruluğundan emin olunuz');
        }

        $expireTimeStamp = $tokenData->expireTime ?? $playerToken->getExpireDate()->getTimestamp();
        if ($expireTimeStamp <= (new \DateTime())->getTimestamp()){
            throw new AuthenticationException('Oturum süresi doldu, lütfen tekrar giriş yapınız');
        }

        return new SelfValidatingPassport(
            $this->checkPlayerRoute($request, $playerToken->getPlayer())
        );
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
            'errors' => $exception->getMessage()
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return true;
    }

    public function checkPlayerRoute(Request $request, UserInterface $player): UserInterface
    {
        if ($request->attributes->get('_route') == 'play') {
            $body = json_decode($request->getContent(), 'assoc');
            if (isset($body['world_id'])) {
                $player->setWorldId($body['world_id']);
            } else {
                throw new AuthenticationException('Dünya bilgisi bulunamadı!');
            }
        }

        return $player;
    }
}