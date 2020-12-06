<?php

namespace App\Model\Response\Building;

class MainBuildingDetailResponse extends BaseBuildingDetailResponse
{
    /** @var BuildingRequirementResponse[]|null */
    protected $buildingRequirements;

    /** @var BuildingCommandResponse[]|null */
    protected $buildingCommands;

    /**
     * @return BuildingRequirementResponse[]|null
     */
    public function getBuildingRequirements(): ?array
    {
        return $this->buildingRequirements;
    }

    /**
     * @param BuildingRequirementResponse[]|null $buildingRequirements
     * @return MainBuildingDetailResponse
     */
    public function setBuildingRequirements(?array $buildingRequirements): MainBuildingDetailResponse
    {
        $this->buildingRequirements = $buildingRequirements;
        return $this;
    }

    /**
     * @return BuildingCommandResponse[]|null
     */
    public function getBuildingCommands(): ?array
    {
        return $this->buildingCommands;
    }

    /**
     * @param BuildingCommandResponse[]|null $buildingCommands
     * @return MainBuildingDetailResponse
     */
    public function setBuildingCommands(?array $buildingCommands): MainBuildingDetailResponse
    {
        $this->buildingCommands = $buildingCommands;
        return $this;
    }
}