<?php

namespace App\Model\Response\Building;

class BaseBuildingDetailResponse implements BaseBuildingDetailResponseInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var int */
    protected $level;

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
     * @return BaseBuildingDetailResponse
     */
    public function setId(int $id): BaseBuildingDetailResponse
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
     * @return BaseBuildingDetailResponse
     */
    public function setName(string $name): BaseBuildingDetailResponse
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return BaseBuildingDetailResponse
     */
    public function setLevel(int $level): BaseBuildingDetailResponse
    {
        $this->level = $level;
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
     * @return BaseBuildingDetailResponse
     */
    public function setIconUrl(string $iconUrl): BaseBuildingDetailResponse
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
     * @return BaseBuildingDetailResponse
     */
    public function setDescription(string $description): BaseBuildingDetailResponse
    {
        $this->description = $description;
        return $this;
    }
}