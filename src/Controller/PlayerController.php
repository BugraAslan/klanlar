<?php

namespace App\Controller;

use App\Entity\Player;

class PlayerController extends BaseController
{
    // TODO prototype !!!
    public function playerVillageInfo()
    {
        /** @var Player $player */
        $player = $this->getUser();

        $villageData = [];
        foreach ($player->getVillages() as $playerVillage){
            $villageUnits = [];
            foreach ($playerVillage->getVillageUnits() as $villageUnit){
                $villageUnits = [
                    'unit_id' => $villageUnit->getUnit()->getId(),
                    'unit_name' => $villageUnit->getUnit()->getName(),
                    'unit_count' => $villageUnit->getUnitCount()
                ];
            }

            $villageBuildings = [];
            foreach ($playerVillage->getVillageBuildings() as $villageBuilding){
                $villageBuildings = [
                    'building_id' => $villageBuilding->getBuilding()->getId(),
                    'building_name' => $villageBuilding->getBuilding()->getName(),
                    'building_level' => $villageBuilding->getBuildingLevel()
                ];
            }

            $villageData[] = [
                'village_id' => $playerVillage->getId(),
                'village_score' => $playerVillage->getScore(),
                'village_coordinate_x' => $playerVillage->getCoordinateX(),
                'village_coordinate_y' => $playerVillage->getCoordinateY(),
                'village_continent' => $playerVillage->getContinent(),
                'village_units' => $villageUnits,
                'village_buildings' => $villageBuildings
            ];
        }

        return $this->successResponse($villageData);
    }
}