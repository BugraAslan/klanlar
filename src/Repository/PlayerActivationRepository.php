<?php

namespace App\Repository;

use App\Entity\PlayerActivation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerActivation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerActivation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerActivation[]    findAll()
 * @method PlayerActivation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerActivationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerActivation::class);
    }
}
