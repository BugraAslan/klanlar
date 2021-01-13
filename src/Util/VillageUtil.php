<?php

namespace App\Util;

use App\Entity\Building;

class VillageUtil
{
    public const DEFAULT_VILLAGE_SCORE = 24;
    public const DEFAULT_RESOURCE = 1000;
    public const DEFAULT_POPULATION = 100;
    public const DEFAULT_WAREHOUSE = 1250;
    public const DEFAULT_FOUNDED_UNIT_IDS = [1, 2]; // mızrak - kılıç

    public static function costCalculator(int $costPerItem, float $costFactor, int $itemLevel)
    {
        return ceil($costPerItem * pow($costFactor, $itemLevel));
    }

    public function getBuildingCost(Building $building, int $level): array
    {
        $totalPopulationCost = self::costCalculator($building->getPopulationCost(), $building->getPopulationFactor(), $level);
        $time = self::costCalculator($building->getBaseBuildTime(), $building->getTimeFactor(), $level);

        return [
            'wood' => self::costCalculator($building->getWoodCost(), $building->getWoodFactor(), $level),
            'clay' => self::costCalculator($building->getClayCost(), $building->getClayFactor(), $level),
            'iron' => self::costCalculator($building->getIronCost(), $building->getIronFactor(), $level),
            'population' => $totalPopulationCost - ceil($totalPopulationCost / $building->getPopulationFactor()),
            'time' => ceil($time > 60 ? $time / 60 : $time)
        ];
    }
}