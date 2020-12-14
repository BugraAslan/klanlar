<?php

namespace App\Model\Response;

class WorldResponse
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return WorldResponse
     */
    public function setId(int $id): WorldResponse
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return WorldResponse
     */
    public function setName(string $name): WorldResponse
    {
        $this->name = $name;
        return $this;
    }
}