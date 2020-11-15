<?php

namespace App\Model\Request\Village;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class VillageIdRequest
{
    /**
     * @var int
     *
     * @Assert\Type("int")
     * @Assert\NotBlank(message="Köy id boş bırakılamaz")
     *
     * @Serializer\Type("int")
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
     * @return VillageIdRequest
     */
    public function setVillageId(int $villageId): VillageIdRequest
    {
        $this->villageId = $villageId;
        return $this;
    }
}