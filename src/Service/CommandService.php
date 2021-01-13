<?php

namespace App\Service;

use App\Entity\Building;
use App\Entity\BuildingCommand;
use App\Entity\PlayerVillage;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Model\Request\Command\BuildingCommandRequest;
use App\Model\Request\Command\UnitCommandRequest;
use App\Util\VillageUtil;
use Doctrine\DBAL\ConnectionException;
use Doctrine\ORM\ORMException;

class CommandService extends BaseService
{
    public function unitCommand(UnitCommandRequest $unitCommandRequest): ?UnitCommand
    {
        $unit = $this->entityManager->getRepository(Unit::class)->find(
            $unitCommandRequest->getUnitId()
        );

        $village = $this->entityManager->getRepository(PlayerVillage::class)->find(
            $unitCommandRequest->getVillageId()
        );

        if (!$unit instanceof Unit || !$village instanceof PlayerVillage) {
            return null;
        }

        try {
            $this->entityManager->getConnection()->beginTransaction();
            $buildTime = $unitCommandRequest->getCommandCount() * ($unit->getBaseBuildTime() / 60);
            $commandCount = $unitCommandRequest->getCommandCount();

            $unitCommand = (new UnitCommand())
                ->setUnit($unit)
                ->setVillage($village)
                ->setStartDate((new \DateTime()))
                ->setEndDate((new \DateTime())->modify('+'.$buildTime.' minutes'))
                ->setCostWood($commandCount * $unit->getCostPerWood())
                ->setCostClay($commandCount * $unit->getCostPerClay())
                ->setCostIron($commandCount * $unit->getCostPerIron())
                ->setCostPopulation($commandCount * $unit->getCostPerPopulation())
                ->setCommandCount($commandCount);

            $this->entityManager->persist($unitCommand);
            $this->entityManager->persist($this->prepareVillageResourceByAfterCommand($village, $unitCommand));
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (ORMException|ConnectionException $e) {
            $this->entityManager->getConnection()->rollBack();
            return null;
        }

        return $unitCommand;
    }

    public function buildingCommand(BuildingCommandRequest $buildingCommandRequest): ?BuildingCommand
    {
        $building = $this->entityManager->getRepository(Building::class)->find(
            $buildingCommandRequest->getBuildingId()
        );

        $village = $this->entityManager->getRepository(PlayerVillage::class)->find(
            $buildingCommandRequest->getVillageId()
        );

        if (!$building instanceof Building || !$village instanceof PlayerVillage) {
            return null;
        }

        $villageUtil = new VillageUtil();
        try {
            $this->entityManager->getConnection()->beginTransaction();

            $buildLevel = $buildingCommandRequest->getBuildLevel();
            $currentBuildingLevel = $buildLevel - 1;
            list($woodCost, $clayCost, $ironCost, $populationCost, $buildTime) = array_values(
                $villageUtil->getBuildingCost($building, $currentBuildingLevel)
            );

            $timeType = $buildTime >= 60 ? 'minute' : 'second';
            $buildingCommand = (new BuildingCommand())
                ->setBuilding($building)
                ->setVillage($village)
                ->setStartDate((new \DateTime()))
                ->setEndDate((new \DateTime())->modify('+'.$buildTime.' '.$timeType))
                ->setCostWood($woodCost)
                ->setCostClay($clayCost)
                ->setCostIron($ironCost)
                ->setCostPopulation($populationCost)
                ->setBuildLevel($buildLevel);

            $this->entityManager->persist($buildingCommand);
            $this->entityManager->persist($this->prepareVillageResourceByAfterCommand($village, $buildingCommand));
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (ORMException|ConnectionException $e) {
            $this->entityManager->getConnection()->rollBack();
            return null;
        }

        return $buildingCommand;
    }

    private function prepareVillageResourceByAfterCommand(PlayerVillage $playerVillage, $commandEntity): PlayerVillage
    {
        return $playerVillage
            ->setIron($playerVillage->getIron() - $commandEntity->getCostIron())
            ->setClay($playerVillage->getClay() - $commandEntity->getCostClay())
            ->setWood($playerVillage->getWood() - $commandEntity->getCostWood())
            ->setPopulation($playerVillage->getPopulation() - $commandEntity->getCostPopulation());
    }
}