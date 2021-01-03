<?php

namespace App\Repository;

use App\Entity\PlayerVillage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlayerVillage|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayerVillage|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayerVillage[]    findAll()
 * @method PlayerVillage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayerVillageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayerVillage::class);
    }

    /**
     * @param int $playerId
     * @param int $villageId
     * @return PlayerVillage|null
     */
    public function findVillageInfo(int $playerId, int $villageId): ?PlayerVillage
    {
        try {
            return $this->createQueryBuilder('playerVillage')
                ->addSelect('villageBuilding')
                ->addSelect('building')
                ->addSelect('villageUnit')
                ->addSelect('unit')
                ->addSelect('resource')
                ->join('playerVillage.villageBuildings', 'villageBuilding')
                ->join('villageBuilding.building', 'building')
                ->join('playerVillage.resource', 'resource')
                ->leftJoin('playerVillage.villageUnits', 'villageUnit')
                ->leftJoin('villageUnit.unit', 'unit')
                ->where('playerVillage.player = :playerId')
                ->andWhere('playerVillage.id = :villageId')
                ->setParameters([
                    'villageId' => $villageId,
                    'playerId' => $playerId
                ])
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    public function findPlayerVillageForDefaultOverview(int $playerId, int $worldId)
    {
        return $this->createQueryBuilder('playerVillage')
            ->addSelect('villageResource')
            ->join('playerVillage.resource', 'villageResource')
            ->where('playerVillage.player = :playerId')
            ->andWhere('playerVillage.worldId = :worldId')
            ->setParameters([
                'playerId' => $playerId,
                'worldId' => $worldId
            ])
            ->getQuery()
            ->getResult();
    }
}