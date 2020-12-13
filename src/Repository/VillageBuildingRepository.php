<?php

namespace App\Repository;

use App\Entity\VillageBuilding;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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
     * @return string|null
     */
    public function findBuildingNameById(int $villageId, int $buildingId): ?string
    {
        try {
            return $this->createQueryBuilder('villageBuilding')
                ->select('building.name')
                ->join('villageBuilding.building', 'building')
                ->where('villageBuilding.village = :villageId')
                ->andWhere('villageBuilding.building = :buildingId')
                ->setParameters([
                    'villageId' => $villageId,
                    'buildingId' => $buildingId
                ])
                ->getQuery()
                ->enableResultCache(9999)
                ->getSingleScalarResult();
        } catch (NoResultException | NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param int $villageId
     * @param int $buildingId
     * @return VillageBuilding|null
     */
    public function findUnitManufacturerBuildingDetail(int $villageId, int $buildingId): ?VillageBuilding
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
                ->join('villageBuilding.village', 'village')
                ->join('village.resource', 'villageResource')
                ->join('building.icons', 'buildingIcons')
                ->join('building.unitManufacturers', 'unitManufacturers')
                ->join('unitManufacturers.unit', 'unit')
                ->join('building.buildingDescription', 'buildingDescription')
                ->leftJoin(
                    'unit.commands', 'unitCommands',
                    'with',
                    'unitCommands.endDate > :now' // TODO unitCommands.isFinished = false
                )
                ->leftJoin('unit.icons', 'unitIcons')
                ->leftJoin('village.villageUnits', 'villageUnits')
                ->where('village.id = :villageId')
                ->andWhere('building.id = :buildingId')
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

    /**
     * @param int $villageId
     * @return VillageBuilding[]|array
     */
    public function findBuildingDetailByVillageId(int $villageId): ?array
    {
        return $this->createQueryBuilder('villageBuilding')
            ->addSelect('building')
            ->addSelect('village')
            ->addSelect('villageResource')
            ->addSelect('buildingDescription')
            ->addSelect('buildingIcons')
            ->join('villageBuilding.village', 'village')
            ->join('villageBuilding.building', 'building')
            ->join('village.resource', 'villageResource')
            ->join('building.icons', 'buildingIcons')
            ->join('building.buildingDescription', 'buildingDescription')
            ->where('village.id = :villageId')
            ->setParameter('villageId', $villageId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $villageId
     * @param int $buildingId
     * @return VillageBuilding|null
     */
    public function findBuildingDetailById(int $villageId, int $buildingId): ?VillageBuilding
    {
        try {
            return $this->createQueryBuilder('villageBuilding')
                ->addSelect('buildingDescription')
                ->addSelect('buildingIcons')
                ->addSelect('building')
                ->join('villageBuilding.building', 'building')
                ->join('building.icons', 'buildingIcons')
                ->join('building.buildingDescription', 'buildingDescription')
                ->where('villageBuilding.village = :villageId')
                ->andWhere('building.id = :buildingId')
                ->setParameters([
                    'villageId' => $villageId,
                    'buildingId' => $buildingId
                ])
                ->getQuery()
                ->enableResultCache(9999)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }

    /**
     * @param int $villageId
     * @param int $buildingId
     * @return VillageBuilding|null
     */
    public function findResourceManufacturerBuildingDetail(int $villageId, int $buildingId): ?VillageBuilding
    {
        try {
            return $this->createQueryBuilder('villageBuilding')
                ->addSelect('buildingDescription')
                ->addSelect('buildingIcons')
                ->addSelect('building')
                ->addSelect('buildingOutput')
                ->join('villageBuilding.building', 'building')
                ->join('building.icons', 'buildingIcons')
                ->join('building.buildingDescription', 'buildingDescription')
                ->join('building.buildingOutput', 'buildingOutput')
                ->where('villageBuilding.village = :villageId')
                ->andWhere('building.id = :buildingId')
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