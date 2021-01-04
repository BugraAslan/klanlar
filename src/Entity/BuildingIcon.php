<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingIcon
 *
 * @ORM\Table(name="building_icon", indexes={@ORM\Index(name="building_icon_building_id_fk", columns={"building_id"})})
 * @ORM\Entity
 */
class BuildingIcon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="morning_icon", type="string", length=500, nullable=true)
     */
    private $morningIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="noon_icon", type="string", length=500, nullable=true)
     */
    private $noonIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="evening_icon", type="string", length=500, nullable=true)
     */
    private $eveningIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="night_icon", type="string", length=500, nullable=true)
     */
    private $nightIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="build_icon", type="string", length=500, nullable=true)
     */
    private $buildIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="base_icon", type="string", length=500, nullable=true)
     */
    private $baseIcon;

    /**
     * @var Building
     *
     * @ORM\OneToOne(targetEntity="Building", inversedBy="icons")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMorningIcon(): ?string
    {
        return $this->morningIcon;
    }

    public function setMorningIcon(?string $morningIcon): self
    {
        $this->morningIcon = $morningIcon;

        return $this;
    }

    public function getNoonIcon(): ?string
    {
        return $this->noonIcon;
    }

    public function setNoonIcon(?string $noonIcon): self
    {
        $this->noonIcon = $noonIcon;

        return $this;
    }

    public function getEveningIcon(): ?string
    {
        return $this->eveningIcon;
    }

    public function setEveningIcon(?string $eveningIcon): self
    {
        $this->eveningIcon = $eveningIcon;

        return $this;
    }

    public function getNightIcon(): ?string
    {
        return $this->nightIcon;
    }

    public function setNightIcon(?string $nightIcon): self
    {
        $this->nightIcon = $nightIcon;

        return $this;
    }

    public function getBuildIcon(): ?string
    {
        return $this->buildIcon;
    }

    public function setBuildIcon(?string $buildIcon): self
    {
        $this->buildIcon = $buildIcon;

        return $this;
    }

    public function getBaseIcon(): ?string
    {
        return $this->baseIcon;
    }

    public function setBaseIcon(?string $baseIcon): self
    {
        $this->baseIcon = $baseIcon;

        return $this;
    }

    public function getBuilding(): ?Building
    {
        return $this->building;
    }

    public function setBuilding(?Building $building): self
    {
        $this->building = $building;

        return $this;
    }
}
