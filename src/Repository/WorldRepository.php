<?php

namespace App\Repository;

use App\Entity\World;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method World|null find($id, $lockMode = null, $lockVersion = null)
 * @method World|null findOneBy(array $criteria, array $orderBy = null)
 * @method World[]    findAll()
 * @method World[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorldRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, World::class);
    }

    /**
     * @param array $excludeWorldIds
     * @return World[]|string
     */
    public function findActiveWorldByExcludeIds(array $excludeWorldIds)
    {
        return $this->createQueryBuilder('world')
            ->where('world.id NOT IN (:excludeWorldIds)')
            ->andWhere('world.status = true')
            ->setParameter('excludeWorldIds', $excludeWorldIds)
            ->getQuery()
            ->getResult();
    }
}