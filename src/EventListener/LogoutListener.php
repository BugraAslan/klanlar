<?php

namespace App\EventListener;

use App\Entity\Player;
use App\Entity\PlayerToken;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * LogoutListener constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onSymfonyComponentSecurityHttpEventLogoutEvent(LogoutEvent $logoutEvent)
    {
        /** @var Player $player */
        $player = $logoutEvent->getToken()->getUser();
        $player
            ->setApiToken(null)
            ->setWorldId(null);

        $playerToken = $this->entityManager->getRepository(PlayerToken::class)->findOneBy([
            'player' => $player->getId()
        ]);

        if ($playerToken instanceof PlayerToken) {
            $this->entityManager->remove($playerToken);
        }

        $this->entityManager->persist($player);
        $this->entityManager->flush();

        $logoutEvent->setResponse(
            new JsonResponse(
                [
                    'success' => true,
                    'data' => 'Başarıyla çıkış yapıldı.',
                    'errors' => null
                ],
                Response::HTTP_OK
            )
        );
    }
}