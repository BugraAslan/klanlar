<?php

namespace App\Manager\Response;

use App\Entity\PlayerVillage;
use App\Entity\Unit;
use App\Entity\VillageBuilding;
use App\Entity\VillageUnit;
use App\Model\Response\Village\VillageInfo\BuildingByVillageInfoResponse;
use App\Model\Response\Village\VillageInfo\UnitByVillageInfoResponse;
use App\Model\Response\Village\VillageInfo\VillageInfoResponse;
use App\Model\Response\Village\VillageResourceResponse;
use App\Model\Response\Village\VillageResponse;
use Doctrine\Common\Collections\ArrayCollection;

class VillageResponseManager
{
    /**
     * @param PlayerVillage $village
     * @return VillageInfoResponse
     */
    public function buildVillageInfoResponse(PlayerVillage $village): VillageInfoResponse
    {
        $villageBuildingCollection = new ArrayCollection();
        foreach ($village->getVillageBuildings() as $villageBuilding){
            if ($villageBuilding instanceof VillageBuilding){
                $villageBuildingCollection->add($this->buildVillageBuildingResponse($villageBuilding));
            }
        }

        $villageUnitCollection = new ArrayCollection();
        foreach ($village->getVillageUnits() as $villageUnit){
            if ($villageUnit instanceof VillageUnit){
                $villageUnitCollection->add($this->buildVillageUnitResponse($villageUnit));
            }
        }

        return (new VillageInfoResponse())
            ->setVillage($this->buildVillageResponse($village))
            ->setBuildings($villageBuildingCollection->toArray())
            ->setResources($this->buildVillageResourceResponse($village))
            ->setUnits($villageUnitCollection->toArray());
    }

    /**
     * @param PlayerVillage $playerVillage
     * @return VillageResourceResponse
     */
    public function buildVillageResourceResponse(PlayerVillage $playerVillage): VillageResourceResponse
    {
        return (new VillageResourceResponse())
            ->setClay($playerVillage->getClay())
            ->setIron($playerVillage->getIron())
            ->setWood($playerVillage->getWood())
            ->setWarehouse($playerVillage->getWarehouse())
            ->setPopulation($playerVillage->getPopulation());
    }

    /**
     * @param PlayerVillage $playerVillage
     * @return VillageResponse
     */
    public function buildVillageResponse(PlayerVillage $playerVillage): VillageResponse
    {
        return (new VillageResponse())
            ->setVillageId($playerVillage->getId())
            ->setVillageName($playerVillage->getName())
            ->setVillageContinent($playerVillage->getContinent())
            ->setVillageCoordinateX($playerVillage->getCoordinateX())
            ->setVillageCoordinateY($playerVillage->getCoordinateY())
            ->setVillageScore($playerVillage->getScore());
    }

    /**
     * @param VillageBuilding $villageBuilding
     * @return BuildingByVillageInfoResponse
     */
    public function buildVillageBuildingResponse(VillageBuilding $villageBuilding): BuildingByVillageInfoResponse
    {
        return (new BuildingByVillageInfoResponse())
            ->setBuildingId($villageBuilding->getBuilding()->getId())
            ->setBuildingName($villageBuilding->getBuilding()->getName())
            ->setBuildingLevel($villageBuilding->getBuildingLevel())
            ->setBuildingIcon($villageBuilding->getBuilding()->getIcons()->getBaseIcon());
    }

    /**
     * @param VillageUnit $villageUnit
     * @return UnitByVillageInfoResponse|null
     */
    public function buildVillageUnitResponse(VillageUnit $villageUnit): ?UnitByVillageInfoResponse
    {
        $response = null;
        if ($villageUnit->getUnit() instanceof Unit){
            $response = (new UnitByVillageInfoResponse())
                ->setUnitCount($villageUnit->getUnitCount())
                ->setUnitIcon($villageUnit->getUnit()->getIcons()->getOverviewIcon())
                ->setUnitName($villageUnit->getUnit()->getName())
                ->setUnitId($villageUnit->getUnit()->getId());
        }

        return $response;
    }
}