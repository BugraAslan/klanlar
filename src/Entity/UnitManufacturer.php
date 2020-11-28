<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UnitManufacturer
 *
 * @ORM\Table(name="unit_manufacturer", indexes={
 *     @ORM\Index(name="unit_manufacturer_unit_id_fk", columns={"unit_id"}),
 *     @ORM\Index(name="unit_manufacturer_building_id_fk", columns={"building_id"})
 * })
 *
 * @ORM\Entity
 */
class UnitManufacturer
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
     * @var Unit|null
     *
     * @ORM\OneToOne(targetEntity="Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * @var Building|null
     *
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="unitManufacturers")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;
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