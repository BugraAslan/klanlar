<?php

namespace App\Model\Request\Command;

use App\Model\Request\VillageIdRequestTrait;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class UnitCommandRequest
{
    use VillageIdRequestTrait;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="Birim id boş bırakılamaz")
     * @Assert\Type("int")
     *
     * @Serializer\Type("integer")
     */
    private $unitId;

    /**
     * @var int
     *
     * @Assert\NotBlank(message="Birim sayısı boş bırakılamaz")
     * @Assert\GreaterThan(value="0", message="Birim sayısı sıfırdan büyük olmalıdır")
     * @Assert\Type("int")
     *
     * @Serializer\Type("integer")
     */
    private $commandCount;

    /**
     * @return int
     */
    public function getUnitId(): int
    {
        return $this->unitId;
    }

    /**
     * @param int $unitId
     * @return UnitCommandRequest
     */
    public function setUnitId(int $unitId): UnitCommandRequest
    {
        $this->unitId = $unitId;
        return $this;
    }

    /**
     * @return int
     */
    public function getCommandCount(): int
    {
        return $this->commandCount;
    }

    /**
     * @param int $commandCount
     * @return UnitCommandRequest
     */
    public function setCommandCount(int $commandCount): UnitCommandRequest
    {
        $this->commandCount = $commandCount;
        return $this;
    }
}