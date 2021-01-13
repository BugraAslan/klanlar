<?php

namespace App\Model\Request\Command;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class BuildingCommandRequest
{
    /**
     * @var int
     *
     * @Assert\NotBlank(message="Köy id boş bırakılamaz")
     * @Assert\Type("int")
     *
     * @Serializer\Type("integer")
     */
    private $villageId;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="Bina id boş bırakılamaz")
     * @Assert\Type("int")
     *
     * @Serializer\Type("integer")
     */
    private $buildingId;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="Bina seviyesi boş bırakılamaz")
     * @Assert\GreaterThan(value="0", message="Bina seviyesi sıfırdan büyük olmalıdır")
     * @Assert\Type("int")
     *
     * @Serializer\Type("integer")
     */
    private $buildLevel;

    /**
     * @return int
     */
    public function getVillageId(): int
    {
        return $this->villageId;
    }

    /**
     * @param int $villageId
     * @return BuildingCommandRequest
     */
    public function setVillageId(int $villageId): BuildingCommandRequest
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
     * @return BuildingCommandRequest
     */
    public function setBuildingId(int $buildingId): BuildingCommandRequest
    {
        $this->buildingId = $buildingId;
        return $this;
    }

    /**
     * @return int
     */
    public function getBuildLevel(): int
    {
        return $this->buildLevel;
    }

    /**
     * @param int $buildLevel
     * @return BuildingCommandRequest
     */
    public function setBuildLevel(int $buildLevel): BuildingCommandRequest
    {
        $this->buildLevel = $buildLevel;
        return $this;
    }
}