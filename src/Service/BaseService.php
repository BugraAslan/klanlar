<?php

namespace App\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseService
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var ContainerInterface */
    protected $container;

    /**
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     * @required
     */
    public function setServiceArguments(
        EntityManagerInterface $entityManager,
        ContainerInterface $container
    ): void {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }
}