<?php

namespace App\Model\Request\Command;

use App\Model\Request\VillageIdRequestTrait;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class CancelCommandRequest
{
    use VillageIdRequestTrait;

    /**
     * @var int
     *
     * @Assert\Type("integer")
     * @Assert\NotNull()
     *
     * @Serializer\Type("integer")
     */
    private $commandId;

    /**
     * @return int
     */
    public function getCommandId(): int
    {
        return $this->commandId;
    }

    /**
     * @param int $commandId
     * @return CancelCommandRequest
     */
    public function setCommandId(int $commandId): CancelCommandRequest
    {
        $this->commandId = $commandId;
        return $this;
    }
}