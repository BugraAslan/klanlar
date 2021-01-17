<?php

namespace App\Model\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

trait VillageIdRequestTrait
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
     * @return int
     */
    public function getVillageId(): int
    {
        return $this->villageId;
    }

    /**
     * @param int $villageId
     * @return VillageIdRequestTrait
     */
    public function setVillageId(int $villageId): VillageIdRequestTrait
    {
        $this->villageId = $villageId;
        return $this;
    }
}