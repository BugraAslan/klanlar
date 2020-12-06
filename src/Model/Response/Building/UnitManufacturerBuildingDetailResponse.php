<?php

namespace App\Model\Response\Building;

use App\Model\Response\Unit\UnitCommandResponse;
use App\Model\Response\Unit\UnitRequirementResponse;

class UnitManufacturerBuildingDetailResponse extends BaseBuildingDetailResponse
{
    /** @var UnitRequirementResponse[]|null */
    protected $unitRequirements;

    /** @var UnitCommandResponse[]|null */
    protected $unitCommands;

    /**
     * @return UnitRequirementResponse[]|null
     */
    public function getUnitRequirements(): ?array
    {
        return $this->unitRequirements;
    }

    /**
     * @param UnitRequirementResponse[]|null $unitRequirements
     * @return UnitManufacturerBuildingDetailResponse
     */
    public function setUnitRequirements(?array $unitRequirements): UnitManufacturerBuildingDetailResponse
    {
        $this->unitRequirements = $unitRequirements;
        return $this;
    }

    /**
     * @return UnitCommandResponse[]|null
     */
    public function getUnitCommands(): ?array
    {
        return $this->unitCommands;
    }

    /**
     * @param UnitCommandResponse[]|null $unitCommands
     * @return UnitManufacturerBuildingDetailResponse
     */
    public function setUnitCommands(?array $unitCommands): UnitManufacturerBuildingDetailResponse
    {
        $this->unitCommands = $unitCommands;
        return $this;
    }
}