<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerVillageUnit
 *
 * @ORM\Table(name="player_village_unit", indexes={
 *     @ORM\Index(name="player_village_unit_player_id_fk", columns={"player_id"}),
 *     @ORM\Index(name="player_village_unit_unit_id_fk", columns={"unit_id"}),
 *     @ORM\Index(name="player_village_unit_player_village_id_fk", columns={"village_id"})
 * })
 *
 * @ORM\Entity
 */
class PlayerVillageUnit
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
     * @var int
     *
     * @ORM\Column(name="unit_count", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $unitCount = '0';

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="villageUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="villageUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     * })
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

    /**
     * @param Unit|null $unit
     * @return PlayerVillageUnit
     */
    public function setUnit(?Unit $unit): PlayerVillageUnit
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

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

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
