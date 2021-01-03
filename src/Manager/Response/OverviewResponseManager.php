<?php

namespace App\Manager\Response;

use App\Entity\PlayerVillage;
use App\Model\Response\Overview\DefaultOverviewResponse;
use Doctrine\Common\Collections\ArrayCollection;

class OverviewResponseManager
{
    /** @var VillageResponseManager */
    private $villageResponseManager;

    /**
     * OverviewResponseManager constructor.
     * @param VillageResponseManager $villageResponseManager
     */
    public function __construct(VillageResponseManager $villageResponseManager)
    {
        $this->villageResponseManager = $villageResponseManager;
    }

    public function buildDefaultOverviewResponseCollection(array $villages): array
    {
        $responseCollection = new ArrayCollection();
        foreach ($villages as $village) {
            if ($village instanceof PlayerVillage) {
                $responseCollection->add(
                    $this->buildDefaultOverviewResponse($village)
                );
            }
        }

        return $responseCollection->toArray();
    }

    public function buildDefaultOverviewResponse(PlayerVillage $playerVillage): DefaultOverviewResponse
    {
        return (new DefaultOverviewResponse())
            ->setVillage(
                $this->villageResponseManager->buildVillageResponse($playerVillage)
            )
            ->setResource(
                $this->villageResponseManager->buildVillageResourceResponse($playerVillage->getResource())
            );
    }
}