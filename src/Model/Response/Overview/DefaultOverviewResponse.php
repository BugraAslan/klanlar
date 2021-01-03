<?php

namespace App\Model\Response\Overview;

use App\Model\Response\Village\VillageResourceResponse;
use App\Model\Response\Village\VillageResponse;

class DefaultOverviewResponse
{
    /** @var VillageResponse */
    private $village;

    /** @var VillageResourceResponse */
    private $resource;

    /**
     * @return VillageResponse
     */
    public function getVillage(): VillageResponse
    {
        return $this->village;
    }

    /**
     * @param VillageResponse $village
     * @return DefaultOverviewResponse
     */
    public function setVillage(VillageResponse $village): DefaultOverviewResponse
    {
        $this->village = $village;
        return $this;
    }

    /**
     * @return VillageResourceResponse
     */
    public function getResource(): VillageResourceResponse
    {
        return $this->resource;
    }

    /**
     * @param VillageResourceResponse $resource
     * @return DefaultOverviewResponse
     */
    public function setResource(VillageResourceResponse $resource): DefaultOverviewResponse
    {
        $this->resource = $resource;
        return $this;
    }
}