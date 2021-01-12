<?php

namespace App\Model\Response\Building;

use App\Model\Response\Unit\UnitFounderResponse;

class SmithBuildingResponse extends BaseBuildingDetailResponse
{
    /** @var UnitFounderResponse[] */
    protected $unitFounders;

    /**
     * @return UnitFounderResponse[]
     */
    public function getUnitFounders(): array
    {
        return $this->unitFounders;
    }

    /**
     * @param UnitFounderResponse[] $unitFounders
     * @return SmithBuildingResponse
     */
    public function setUnitFounders(array $unitFounders): SmithBuildingResponse
    {
        $this->unitFounders = $unitFounders;
        return $this;
    }
}