<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VillageBuilding
 *
 * @ORM\Table(name="village_building", indexes={
 *     @ORM\Index(name="village_building_building_id_fk", columns={"building_id"}),
 *     @ORM\Index(name="village_building_village_id_fk", columns={"village_id"})
 * })
 *
 * @ORM\Entity
 */
class VillageBuilding
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="building_level", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $buildingLevel;

    /**
     * @var Building
     *
     * @ORM\OneToOne(targetEntity="Building")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     * })
     */
    private $building;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="villageBuildings")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     * })
     */
    private $village;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildingLevel(): ?int
    {
        return $this->buildingLevel;
    }

    public function setBuildingLevel(?int $buildingLevel): self
    {
        $this->buildingLevel = $buildingLevel;

        return $this;
    }

    public function getVillage(): ?PlayerVillage
    {
        return $this->village;
    }

    public function setVillage(?PlayerVillage $village): self
    {
        $this->village = $village;

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
