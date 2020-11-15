<?php

namespace App\Manager\Response;

use App\Entity\PlayerVillage;
use App\Entity\Unit;
use App\Entity\VillageBuilding;
use App\Entity\VillageResource;
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
    public function buildVillageInfoResponse(PlayerVillage $village)
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
            ->setResources($this->buildVillageResourceResponse($village->getResource()))
            ->setUnits($villageUnitCollection->toArray());
    }

    /**
     * @param VillageResource $resource
     * @return VillageResourceResponse
     */
    public function buildVillageResourceResponse(VillageResource $resource)
    {
        return (new VillageResourceResponse())
            ->setClay($resource->getClay())
            ->setIron($resource->getIron())
            ->setWood($resource->getWood());
    }

    /**
     * @param PlayerVillage $playerVillage
     * @return VillageResponse
     */
    public function buildVillageResponse(PlayerVillage $playerVillage)
    {
        return (new VillageResponse())
            ->setVillageContinent($playerVillage->getContinent())
            ->setVillageCoordinateX($playerVillage->getCoordinateX())
            ->setVillageCoordinateY($playerVillage->getCoordinateY())
            ->setVillageId($playerVillage->getId())
            ->setVillageScore($playerVillage->getScore());
    }

    /**
     * @param VillageBuilding $villageBuilding
     * @return BuildingByVillageInfoResponse
     */
    public function buildVillageBuildingResponse(VillageBuilding $villageBuilding)
    {
        return (new BuildingByVillageInfoResponse())
            ->setBuildingLevel($villageBuilding->getBuildingLevel())
            ->setBuildingId($villageBuilding->getBuilding()->getId())
            ->setBuildingName($villageBuilding->getBuilding()->getName())
            ->setBuildingIcon('icon url'); // TODO $villageBuilding->getBuilding()->getBaseIcon()
    }

    /**
     * @param VillageUnit $villageUnit
     * @return UnitByVillageInfoResponse|null
     */
    public function buildVillageUnitResponse(VillageUnit $villageUnit)
    {
        $response = null;
        if ($villageUnit->getUnit() instanceof Unit){
            $response = (new UnitByVillageInfoResponse())
                ->setUnitCount($villageUnit->getUnitCount())
                ->setUnitIcon('icon url') // TODO $villageUnit->getUnit()->getBaseIcon()
                ->setUnitName($villageUnit->getUnit()->getName())
                ->setUnitId($villageUnit->getUnit()->getId());
        }

        return $response;
    }
}