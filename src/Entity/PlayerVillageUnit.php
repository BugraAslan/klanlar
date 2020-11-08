<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerVillageUnit
 *
 * @ORM\Table(name="player_village_unit", indexes={
 *     @ORM\Index(name="player_village_unit_player_id_fk", columns={"player_id"}),
 *     @ORM\Index(name="player_village_unit_player_village_id_fk", columns={"village_id"})
 * })
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
     * @var int
     *
     * @ORM\Column(name="unit_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $unitId;

    /**
     * @var int
     *
     * @ORM\Column(name="unit_count", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $unitCount = '0';

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Player", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PlayerVillage", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     * })
     */
    private $village;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUnitId(): ?int
    {
        return $this->unitId;
    }

    public function setUnitId(int $unitId): self
    {
        $this->unitId = $unitId;

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
