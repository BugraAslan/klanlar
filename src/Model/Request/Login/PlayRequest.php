<?php

namespace App\Model\Request\Login;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class PlayRequest
{
    /**
     * @var int
     *
     * @Assert\Type("int")
     * @Assert\NotBlank(message="Dünya id giriniz")
     * @Serializer\Type("int")
     */
    protected $worldId;

    /**
     * @var bool
     *
     * @Assert\Type("bool")
     * @Assert\NotNull(message="Oyuncu-dünya durumunu giriniz")
     * @Serializer\Type("bool")
     */
    protected $isPlaying;

    /**
     * @return int
     */
    public function getWorldId(): int
    {
        return $this->worldId;
    }

    /**
     * @param int $worldId
     * @return PlayRequest
     */
    public function setWorldId(int $worldId): PlayRequest
    {
        $this->worldId = $worldId;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPlaying(): bool
    {
        return $this->isPlaying;
    }

    /**
     * @param bool $isPlaying
     * @return PlayRequest
     */
    public function setIsPlaying(bool $isPlaying): PlayRequest
    {
        $this->isPlaying = $isPlaying;
        return $this;
    }
}