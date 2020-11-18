<?php

namespace App\Repository;

use App\Entity\Building;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Building|null find($id, $lockMode = null, $lockVersion = null)
 * @method Building|null findOneBy(array $criteria, array $orderBy = null)
 * @method Building[]    findAll()
 * @method Building[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Building::class);
    }

    /**
     * @param int $id
     * @param int $cacheLifeTime
     * @return Building|null
     */
    public function findBuildingById(int $id, int $cacheLifeTime = 0)
    {
        $queryBuilder = $this->createQueryBuilder('building')
            ->where('building.id = :buildingId')
            ->setParameter('buildingId', $id)
            ->getQuery();

        if ($cacheLifeTime){
            $queryBuilder->enableResultCache($cacheLifeTime);
        }

        try {
            return $queryBuilder->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
