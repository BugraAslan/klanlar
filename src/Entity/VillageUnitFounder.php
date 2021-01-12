<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VillageUnitFounder
 *
 * @ORM\Table(name="village_unit_founder", indexes={
 *     @ORM\Index(name="village_unit_founder_village_id_fk", columns={"village_id"}),
 *     @ORM\Index(name="village_unit_founder_unit_id_fk", columns={"unit_id"})
 * })
 *
 * @ORM\Entity
 */
class VillageUnitFounder
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
     * @var PlayerVillage|null
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="villageUnitFounders")
     * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     */
    private $village;

    /**
     * @var int
     *
     * @ORM\Column(name="unit_level", type="smallint", options={"unsigned"=true,"default"="1"})
     */
    private $unitLevel = 1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_found", type="boolean", options={"default"=false})
     */
    private $isFound = false;

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

    public function getUnitLevel(): int
    {
        return $this->unitLevel;
    }

    public function setUnitLevel(int $unitLevel): self
    {
        $this->unitLevel = $unitLevel;
        return $this;
    }

    public function isFound(): bool
    {
        return $this->isFound;
    }

    public function setIsFound(bool $isFound): self
    {
        $this->isFound = $isFound;
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
