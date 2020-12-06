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
    public function findBuildingDetail(int $villageId, int $buildingId): ?VillageBuilding
    {
        try {
            return $this->createQueryBuilder('villageBuilding')
                ->addSelect('building')
                ->addSelect('village')
                ->addSelect('villageUnits')
                ->addSelect('villageResource')
                ->addSelect('unitManufacturers')
                ->addSelect('unit')
                ->addSelect('unitIcons')
                ->addSelect('buildingDescription')
                ->addSelect('buildingIcons')
                ->addSelect('unitCommands')
                ->join('villageBuilding.building', 'building')
                ->leftJoin('building.buildingDescription', 'buildingDescription')
                ->leftJoin('building.icons', 'buildingIcons')
                ->join('building.unitManufacturers', 'unitManufacturers')
                ->join('unitManufacturers.unit', 'unit')
                ->leftJoin(
                    'unit.commands', 'unitCommands',
                    'with',
                    'unitCommands.endDate > :now' // TODO unitCommands.isFinished = 0
                )
                ->leftJoin('unit.icons', 'unitIcons')
                ->join('villageBuilding.village', 'village')
                ->leftJoin('village.villageUnits', 'villageUnits')
                ->join('village.resource', 'villageResource')
                ->where('villageBuilding.village = :villageId')
                ->andWhere('villageBuilding.building = :buildingId')
                ->setParameters([
                    'villageId' => $villageId,
                    'buildingId' => $buildingId,
                    'now' => new \DateTime()
                ])
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}