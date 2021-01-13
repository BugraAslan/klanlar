<?php

namespace App\Repository;

use App\Entity\UnitCommand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnitCommand|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnitCommand|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnitCommand[]    findAll()
 * @method UnitCommand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnitCommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnitCommand::class);
    }

    /**
     * @param int $villageId
     * @return UnitCommand[]
     */
    public function findUnitCommandsByVillageId(int $villageId): ?array
    {
        return $this->createQueryBuilder('unitCommand')
            ->addSelect('unit')
            ->addSelect('unitIcons')
            ->join('unitCommand.unit', 'unit')
            ->join('unit.icons', 'unitIcons')
            ->where('unitCommand.isFinished = false')
            ->andWhere('unitCommand.village = :villageId')
            ->setParameter('villageId', $villageId)
            ->getQuery()
            ->getResult();
    }
}
