<?php

namespace App\Model\Response;

class EffectResponse
{
    /** @var string */
    private $type;

    /** @var int */
    private $percentage;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return EffectResponse
     */
    public function setType(string $type): EffectResponse
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getPercentage(): int
    {
        return $this->percentage;
    }

    /**
     * @param int $percentage
     * @return EffectResponse
     */
    public function setPercentage(int $percentage): EffectResponse
    {
        $this->percentage = $percentage;
        return $this;
    }
}