<?php

namespace App\Model\Response\Building;

class BaseBuildingResponse
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $iconUrl;

    /** @var string */
    protected $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BaseBuildingResponse
     */
    public function setId(int $id): BaseBuildingResponse
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
     * @return BaseBuildingResponse
     */
    public function setName(string $name): BaseBuildingResponse
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIconUrl(): string
    {
        return $this->iconUrl;
    }

    /**
     * @param string $iconUrl
     * @return BaseBuildingResponse
     */
    public function setIconUrl(string $iconUrl): BaseBuildingResponse
    {
        $this->iconUrl = $iconUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return BaseBuildingResponse
     */
    public function setDescription(string $description): BaseBuildingResponse
    {
        $this->description = $description;
        return $this;
    }
}