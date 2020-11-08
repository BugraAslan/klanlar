<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// TODO building

/**
 * PlayerVillageBuilding
 *
 * @ORM\Table(name="player_village_building", indexes={@ORM\Index(name="player_village_building_building_id_fk", columns={"building_id"}), @ORM\Index(name="player_village_building_player_id_fk", columns={"player_id"}), @ORM\Index(name="player_village_building_player_village_id_fk", columns={"village_id"})})
 * @ORM\Entity
 */
class PlayerVillageBuilding
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
     * @ORM\OneToOne(targetEntity="Building", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     * })
     */
    private $building;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="id")
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
