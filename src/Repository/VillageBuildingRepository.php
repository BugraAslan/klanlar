<?php

namespace App\Repository;

use App\Entity\VillageBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VillageBuilding|null find($id, $lockMode = null, $lockVersion = null)
 * @method VillageBuilding|null findOneBy(array $criteria, array $orderBy = null)
 * @method VillageBuilding[]    findAll()
 * @method VillageBuilding[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VillageBuildingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VillageBuilding::class);
    }

    /**
     * @param int $villageId
     * @param int $buildingId
     * @return VillageBuilding|null
     */
    public function findBuildingDetail(int $villageId, int $buildingId)
    {
        try {
            return $this->createQueryBuilder('villageBuilding')
                ->addSelect('building')
                ->addSelect('village')
                ->addSelect('villageUnits')
                ->addSelect('villageResource')
                ->addSelect('unitManufacturers')
                ->addSelect('unit')
                ->join('villageBuilding.building', 'building')
                ->join('villageBuilding.village', 'village')
                ->leftJoin('village.villageUnits', 'villageUnits')
                ->leftJoin('villageUnits.unit', 'unit')
                ->leftJoin('village.resource', 'villageResource')
                ->leftJoin('building.unitManufacturers', 'unitManufacturers')
                ->where('villageBuilding.village = :villageId')
                ->andWhere('villageBuilding.building = :buildingId')
                ->setParameters([
                    'villageId' => $villageId,
                    'buildingId' => $buildingId
                ])
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}