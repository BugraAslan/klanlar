<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerVillage
 *
 * @ORM\Table(name="player_village", indexes={@ORM\Index(name="player_village_player_id_fk", columns={"player_id"})})
 * @ORM\Entity
 */
class PlayerVillage
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
     * @ORM\Column(name="score", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $score = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="coordinate_x", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $coordinateX;

    /**
     * @var int
     *
     * @ORM\Column(name="coordinate_y", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $coordinateY;

    /**
     * @var int
     *
     * @ORM\Column(name="continent", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $continent;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="villages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    /**
     * @ORM\OneToMany(targetEntity="PlayerVillageBuilding", mappedBy="village")
     */
    private $villageBuildings;

    /**
     * @ORM\OneToMany(targetEntity="PlayerVillageUnit", mappedBy="village")
     */
    private $villageUnits;

    /**
     * @ORM\OneToMany(targetEntity="Command", mappedBy="sourceVillage")
     */
    private $commandSourceVillages;

    /**
     * @ORM\OneToMany(targetEntity="Command", mappedBy="targetVillage")
     */
    private $commandTargetVillages;

    /**
     * PlayerVillage constructor.
     */
    public function __construct()
    {
        $this->villageBuildings = new ArrayCollection();
        $this->villageUnits = new ArrayCollection();
        $this->commandSourceVillages = new ArrayCollection();
        $this->commandTargetVillages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setVillageScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getCoordinateX(): ?int
    {
        return $this->coordinateX;
    }

    public function setCoordinateX(int $coordinateX): self
    {
        $this->coordinateX = $coordinateX;

        return $this;
    }

    public function getCoordinateY(): ?int
    {
        return $this->coordinateY;
    }

    public function setCoordinateY(int $coordinateY): self
    {
        $this->coordinateY = $coordinateY;

        return $this;
    }

    public function getContinent(): ?int
    {
        return $this->continent;
    }

    public function setContinent(int $continent): self
    {
        $this->continent = $continent;

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

    /**
     * @return Collection|PlayerVillageBuilding[]
     */
    public function getVillageBuildings(): Collection
    {
        return $this->villageBuildings;
    }

    public function addVillageBuilding(PlayerVillageBuilding $villageBuilding): self
    {
        if (!$this->villageBuildings->contains($villageBuilding)) {
            $this->villageBuildings[] = $villageBuilding;
            $villageBuilding->setVillage($this);
        }

        return $this;
    }

    public function removeVillageBuilding(PlayerVillageBuilding $villageBuilding): self
    {
        if ($this->villageBuildings->removeElement($villageBuilding)) {
            // set the owning side to null (unless already changed)
            if ($villageBuilding->getVillage() === $this) {
                $villageBuilding->setVillage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlayerVillageUnit[]
     */
    public function getVillageUnits(): Collection
    {
        return $this->villageUnits;
    }

    public function addVillageUnit(PlayerVillageUnit $villageUnit): self
    {
        if (!$this->villageUnits->contains($villageUnit)) {
            $this->villageUnits[] = $villageUnit;
            $villageUnit->setVillage($this);
        }

        return $this;
    }

    public function removeVillageUnit(PlayerVillageUnit $villageUnit): self
    {
        if ($this->villageUnits->removeElement($villageUnit)) {
            // set the owning side to null (unless already changed)
            if ($villageUnit->getVillage() === $this) {
                $villageUnit->setVillage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommandSourceVillages(): Collection
    {
        return $this->commandSourceVillages;
    }

    public function addCommandSourceVillage(Command $commandSourceVillage): self
    {
        if (!$this->commandSourceVillages->contains($commandSourceVillage)) {
            $this->commandSourceVillages[] = $commandSourceVillage;
            $commandSourceVillage->setSourceVillage($this);
        }

        return $this;
    }

    public function removeCommandSourceVillage(Command $commandSourceVillage): self
    {
        if ($this->commandSourceVillages->removeElement($commandSourceVillage)) {
            // set the owning side to null (unless already changed)
            if ($commandSourceVillage->getSourceVillage() === $this) {
                $commandSourceVillage->setSourceVillage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommandTargetVillages(): Collection
    {
        return $this->commandTargetVillages;
    }

    public function addCommandTargetVillage(Command $commandTargetVillage): self
    {
        if (!$this->commandTargetVillages->contains($commandTargetVillage)) {
            $this->commandTargetVillages[] = $commandTargetVillage;
            $commandTargetVillage->setTargetVillage($this);
        }

        return $this;
    }

    public function removeCommandTargetVillage(Command $commandTargetVillage): self
    {
        if ($this->commandTargetVillages->removeElement($commandTargetVillage)) {
            // set the owning side to null (unless already changed)
            if ($commandTargetVillage->getTargetVillage() === $this) {
                $commandTargetVillage->setTargetVillage(null);
            }
        }

        return $this;
    }
}
