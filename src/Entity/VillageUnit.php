<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VillageUnit
 *
 * @ORM\Table(name="village_unit", indexes={
 *     @ORM\Index(name="village_unit_unit_id_fk", columns={"unit_id"}),
 *     @ORM\Index(name="village_unit_village_id_fk", columns={"village_id"})
 * })
 *
 * @ORM\Entity
 */
class VillageUnit
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
     * @var Unit|null
     *
     * @ORM\OneToOne(targetEntity="Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * @var int
     *
     * @ORM\Column(name="unit_count", type="smallint", options={"unsigned"=true,"default"="0"})
     */
    private $unitCount = 0;

    /**
     * @var PlayerVillage|null
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="villageUnits")
     * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     */
    private $village;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Unit|null
     */
    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;
        return $this;
    }

    public function getUnitCount(): ?int
    {
        return $this->unitCount;
    }

    public function setUnitCount(int $unitCount): self
    {
        $this->unitCount = $unitCount;

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
}
