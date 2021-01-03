<?php

namespace App\Model\Response\Village;

class VillageResponse
{
    /** @var int */
    private $villageId;

    /** @var string */
    private $villageName;

    /** @var int */
    private $villageScore;

    /** @var int */
    private $villageCoordinateX;

    /** @var int */
    private $villageCoordinateY;

    /** @var int */
    private $villageContinent;

    /**
     * @return int
     */
    public function getVillageId(): int
    {
        return $this->villageId;
    }

    /**
     * @param int $villageId
     * @return VillageResponse
     */
    public function setVillageId(int $villageId): VillageResponse
    {
        $this->villageId = $villageId;
        return $this;
    }

    /**
     * @return string
     */
    public function getVillageName(): string
    {
        return $this->villageName;
    }

    /**
     * @param string $villageName
     * @return VillageResponse
     */
    public function setVillageName(string $villageName): VillageResponse
    {
        $this->villageName = $villageName;
        return $this;
    }

    /**
     * @return int
     */
    public function getVillageScore(): int
    {
        return $this->villageScore;
    }

    /**
     * @param int $villageScore
     * @return VillageResponse
     */
    public function setVillageScore(int $villageScore): VillageResponse
    {
        $this->villageScore = $villageScore;
        return $this;
    }

    /**
     * @return int
     */
    public function getVillageCoordinateX(): int
    {
        return $this->villageCoordinateX;
    }

    /**
     * @param int $villageCoordinateX
     * @return VillageResponse
     */
    public function setVillageCoordinateX(int $villageCoordinateX): VillageResponse
    {
        $this->villageCoordinateX = $villageCoordinateX;
        return $this;
    }

    /**
     * @return int
     */
    public function getVillageCoordinateY(): int
    {
        return $this->villageCoordinateY;
    }

    /**
     * @param int $villageCoordinateY
     * @return VillageResponse
     */
    public function setVillageCoordinateY(int $villageCoordinateY): VillageResponse
    {
        $this->villageCoordinateY = $villageCoordinateY;
        return $this;
    }

    /**
     * @return int
     */
    public function getVillageContinent(): int
    {
        return $this->villageContinent;
    }

    /**
     * @param int $villageContinent
     * @return VillageResponse
     */
    public function setVillageContinent(int $villageContinent): VillageResponse
    {
        $this->villageContinent = $villageContinent;
        return $this;
    }
}