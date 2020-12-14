<?php

namespace App\Repository;

use App\Entity\PlayerWorld;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerWorld|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerWorld|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerWorld[]    findAll()
 * @method PlayerWorld[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerWorldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerWorld::class);
    }
}