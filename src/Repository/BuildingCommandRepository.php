<?php

namespace App\Repository;

use App\Entity\BuildingCommand;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BuildingCommand|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuildingCommand|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuildingCommand[]    findAll()
 * @method BuildingCommand[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildingCommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuildingCommand::class);
    }

    /**
     * @param int $villageId
     * @return BuildingCommand[]
     */
    public function findBuildingCommandsByVillageId(int $villageId): ?array
    {
        return $this->createQueryBuilder('buildingCommand')
            ->addSelect('building')
            ->addSelect('buildingIcons')
            ->join('buildingCommand.building', 'building')
            ->join('building.icons', 'buildingIcons')
            ->where('buildingCommand.endDate > :now') // TODO buildingCommand.isFinished = false
            ->andWhere('buildingCommand.village = :villageId')
            ->setParameters([
                'villageId' => $villageId,
                'now' => new \DateTime()
            ])
            ->getQuery()
            ->getResult();
    }
}
