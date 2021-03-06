<?php

namespace App\Manager\Response;

use App\Entity\VillageBuilding;
use App\Entity\VillageUnitFounder;
use App\Model\Response\Building\BaseBuildingDetailResponseInterface;
use App\Model\Response\CostResponse;
use App\Model\Response\Unit\UnitFounderResponse;
use Doctrine\Common\Collections\ArrayCollection;

class BuildingDetailResponseManager
{
    use CostResponseManagerTrait;

    public function buildBuildingDetailResponse(VillageBuilding $villageBuilding, BaseBuildingDetailResponseInterface $response): BaseBuildingDetailResponseInterface
    {
        $building = $villageBuilding->getBuilding();
        return $response
            ->setId($building->getId())
            ->setName($building->getName())
            ->setDescription($building->getDescription())
            ->setIconUrl($villageBuilding->getBuilding()->getIcons()->getBaseIcon())
            ->setLevel($villageBuilding->getBuildingLevel());
    }

    /**
     * @param VillageUnitFounder[] $villageUnitFounders
     * @return UnitFounderResponse[]
     */
    public function buildUnitFounderResponseCollection(array $villageUnitFounders): array
    {
        $unitFounderResponseCollection = new ArrayCollection();
        foreach ($villageUnitFounders as $villageUnitFounder) {
            $unit = $villageUnitFounder->getUnit();
            $unitFounderResponseCollection->add(
                (new UnitFounderResponse())
                    ->setIsFound($villageUnitFounder->isFound())
                    ->setId($unit->getId())
                    ->setName($unit->getName())
                    ->setIconUrl($unit->getIcons()->getOverviewIcon())
                    ->setLevel($villageUnitFounder->getUnitLevel())
                    ->setCosts(
                        (new CostResponse())
                            ->setWood($unit->getCostPerWood() * 20)
                            ->setClay($unit->getCostPerClay() * 20)
                            ->setIron($unit->getCostPerIron() * 20)
                            ->setPopulation(0)
                    )
            );
        }

        return $unitFounderResponseCollection->toArray();
    }
}