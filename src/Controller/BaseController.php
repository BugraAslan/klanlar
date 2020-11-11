<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class BaseController extends AbstractFOSRestController
{
    use ResponseTrait;

    /** @var EntityManagerInterface */
    public $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     * @required
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }
}