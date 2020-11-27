<?php

namespace App\Service;

use App\Entity\Player;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Security;

class BaseService
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var ContainerInterface */
    protected $container;

    /** @var Player */
    protected $player;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     * @param Security $security
     * @required
     */
    public function setServiceArguments(
        EntityManagerInterface $entityManager,
        ContainerInterface $container,
        Security $security
    ): void {
        $this->entityManager = $entityManager;
        $this->container = $container;
        $this->player = $security->getUser();
    }
}