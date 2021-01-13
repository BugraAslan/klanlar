<?php

namespace App\Service;

use App\Entity\PlayerVillage;
use App\Entity\Unit;
use App\Entity\UnitCommand;
use App\Model\Request\Command\BuildingCommandRequest;
use App\Model\Request\Command\UnitCommandRequest;
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

            $village
                ->setIron($village->getIron() - $unitCommand->getCostIron())
                ->setClay($village->getClay() - $unitCommand->getCostClay())
                ->setWood($village->getWood() - $unitCommand->getCostWood())
                ->setPopulation($village->getPopulation() - $unitCommand->getCostPopulation());

            $this->entityManager->persist($unitCommand);
            $this->entityManager->persist($village);
            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();
        } catch (ORMException|ConnectionException $e) {
            $this->entityManager->getConnection()->rollBack();
            return null;
        }

        return $unitCommand;
    }

    public function buildingCommand(BuildingCommandRequest $buildingCommandRequest)
    {

    }
}