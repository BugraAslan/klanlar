<?php

namespace App\Manager\Response;

use App\Entity\Player;
use App\Entity\PlayerWorld;
use App\Entity\World;
use App\Model\Response\Login\PlayerWorldResponse;
use App\Model\Response\Login\WorldLoginResponse;
use App\Model\Response\WorldResponse;
use Doctrine\Common\Collections\ArrayCollection;

class WorldResponseManager
{
    public function buildWorldResponseCollection(array $worlds): array
    {
        $worldsResponseCollection = new ArrayCollection();
        foreach ($worlds as $world) {
            if ($world instanceof World) {
                $id = $world->getId();
                $name = $world->getName();
            } else if ($world instanceof PlayerWorld) {
                $id = $world->getWorld()->getId();
                $name = $world->getWorld()->getName();
            } else {
                break;
            }

            $worldsResponseCollection->add(
                (new WorldResponse())
                    ->setId($id)
                    ->setName($name)
            );
        }

        return $worldsResponseCollection->toArray();
    }

    public function buildPlayerWorldResponse(Player $player, array $availableWorlds): PlayerWorldResponse
    {
        return (new PlayerWorldResponse())
            ->setAvailableWorlds($this->buildWorldResponseCollection($availableWorlds))
            ->setPlayerWorlds($this->buildWorldResponseCollection($player->getWorlds()->toArray()))
            ->setUsername($player->getUsername());
    }
}