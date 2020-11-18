<?php

namespace App\Model\Request\Building;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class BuildingDetailRequest
{
    /**
     * @var int
     *
     * @Assert\NotBlank(message="Köy id boş bırakılamaz")
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $villageId;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="Köy id boş bırakılamaz")
     * @Assert\Type("int")
     *
     * @Serializer\Type("int")
     */
    private $buildingId;

    /**
     * @return int
     */
    public function getVillageId(): int
    {
        return $this->villageId;
    }

    /**
     * @param int $villageId
     * @return BuildingDetailRequest
     */
    public function setVillageId(int $villageId): BuildingDetailRequest
    {
        $this->villageId = $villageId;
        return $this;
    }

    /**
     * @return int
     */
    public function getBuildingId(): int
    {
        return $this->buildingId;
    }

    /**
     * @param int $buildingId
     * @return BuildingDetailRequest
     */
    public function setBuildingId(int $buildingId): BuildingDetailRequest
    {
        $this->buildingId = $buildingId;
        return $this;
    }
}