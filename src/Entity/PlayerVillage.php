<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerVillage
 *
 * @ORM\Table(name="player_village", indexes={@ORM\Index(name="player_village_player_id_fk", columns={"player_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PlayerVillageRepository")
 */
class PlayerVillage
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=55)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="score", type="smallint", options={"unsigned"=true})
     */
    private $score = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="coordinate_x", type="smallint", options={"unsigned"=true})
     */
    private $coordinateX;

    /**
     * @var int
     *
     * @ORM\Column(name="coordinate_y", type="smallint", options={"unsigned"=true})
     */
    private $coordinateY;

    /**
     * @var int
     *
     * @ORM\Column(name="continent", type="smallint", options={"unsigned"=true})
     */
    private $continent;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="villages")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="world_id", type="integer", options={"unsigned"=true})
     */
    private $worldId;

    /**
     * @ORM\OneToMany(targetEntity="VillageBuilding", mappedBy="village")
     */
    private $villageBuildings;

    /**
     * @ORM\OneToMany(targetEntity="VillageUnit", mappedBy="village")
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
     * @ORM\OneToMany(targetEntity="UnitCommand", mappedBy="village")
     */
    private $unitCommands;

    /**
     * @ORM\OneToMany(targetEntity="BuildingCommand", mappedBy="village")
     */
    private $buildingCommands;

    /**
     * @var int
     *
     * @ORM\Column(name="wood", type="integer", options={"unsigned"=true})
     */
    private $wood;

    /**
     * @var int
     *
     * @ORM\Column(name="clay", type="integer", options={"unsigned"=true})
     */
    private $clay;

    /**
     * @var int
     *
     * @ORM\Column(name="iron", type="integer", options={"unsigned"=true})
     */
    private $iron;

    /**
     * @var int
     *
     * @ORM\Column(name="warehouse", type="integer", options={"unsigned"=true})
     */
    private $warehouse;

    /**
     * @var int
     *
     * @ORM\Column(name="population", type="smallint", options={"unsigned"=true})
     */
    private $population;

    /**
     * @var int
     *
     * @ORM\Column(name="loyalty", type="smallint", options={"unsigned"=true})
     */
    private $loyalty = 100;

    /**
     * PlayerVillage constructor.
     */
    public function __construct()
    {
        $this->villageBuildings = new ArrayCollection();
        $this->villageUnits = new ArrayCollection();
        $this->commandSourceVillages = new ArrayCollection();
        $this->commandTargetVillages = new ArrayCollection();
        $this->unitCommands = new ArrayCollection();
        $this->buildingCommands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
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

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function setPlayer(Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getWorldId(): int
    {
        return $this->worldId;
    }

    public function setWorldId(int $worldId): PlayerVillage
    {
        $this->worldId = $worldId;
        return $this;
    }

    public function getVillageBuildings(): Collection
    {
        return $this->villageBuildings;
    }

    public function addVillageBuilding(VillageBuilding $villageBuilding): self
    {
        if (!$this->villageBuildings->contains($villageBuilding)) {
            $this->villageBuildings[] = $villageBuilding;
            $villageBuilding->setVillage($this);
        }

        return $this;
    }

    public function removeVillageBuilding(VillageBuilding $villageBuilding): self
    {
        if ($this->villageBuildings->removeElement($villageBuilding)) {
            // set the owning side to null (unless already changed)
            if ($villageBuilding->getVillage() === $this) {
                $villageBuilding->setVillage(null);
            }
        }

        return $this;
    }

    public function getVillageUnits(): Collection
    {
        return $this->villageUnits;
    }

    public function addVillageUnit(VillageUnit $villageUnit): self
    {
        if (!$this->villageUnits->contains($villageUnit)) {
            $this->villageUnits[] = $villageUnit;
            $villageUnit->setVillage($this);
        }

        return $this;
    }

    public function removeVillageUnit(VillageUnit $villageUnit): self
    {
        if ($this->villageUnits->removeElement($villageUnit)) {
            // set the owning side to null (unless already changed)
            if ($villageUnit->getVillage() === $this) {
                $villageUnit->setVillage(null);
            }
        }

        return $this;
    }

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

    public function getLoyalty(): int
    {
        return $this->loyalty;
    }

    public function setLoyalty(int $loyalty): self
    {
        $this->loyalty = $loyalty;
        return $this;
    }

    /**
     * @return int
     */
    public function getWood(): int
    {
        return $this->wood;
    }

    /**
     * @param int $wood
     * @return PlayerVillage
     */
    public function setWood(int $wood): PlayerVillage
    {
        $this->wood = $wood;
        return $this;
    }

    /**
     * @return int
     */
    public function getClay(): int
    {
        return $this->clay;
    }

    /**
     * @param int $clay
     * @return PlayerVillage
     */
    public function setClay(int $clay): PlayerVillage
    {
        $this->clay = $clay;
        return $this;
    }

    /**
     * @return int
     */
    public function getIron(): int
    {
        return $this->iron;
    }

    /**
     * @param int $iron
     * @return PlayerVillage
     */
    public function setIron(int $iron): PlayerVillage
    {
        $this->iron = $iron;
        return $this;
    }

    /**
     * @return int
     */
    public function getWarehouse(): int
    {
        return $this->warehouse;
    }

    /**
     * @param int $warehouse
     * @return PlayerVillage
     */
    public function setWarehouse(int $warehouse): PlayerVillage
    {
        $this->warehouse = $warehouse;
        return $this;
    }

    /**
     * @return int
     */
    public function getPopulation(): int
    {
        return $this->population;
    }

    /**
     * @param int $population
     * @return PlayerVillage
     */
    public function setPopulation(int $population): PlayerVillage
    {
        $this->population = $population;
        return $this;
    }

    public function getUnitCommands(): Collection
    {
        return $this->unitCommands;
    }

    public function addUnitCommand(UnitCommand $unitCommand): self
    {
        if (!$this->unitCommands->contains($unitCommand)) {
            $this->unitCommands[] = $unitCommand;
            $unitCommand->setVillage($this);
        }

        return $this;
    }

    public function removeUnitCommand(UnitCommand $unitCommand): self
    {
        if ($this->unitCommands->removeElement($unitCommand)) {
            // set the owning side to null (unless already changed)
            if ($unitCommand->getVillage() === $this) {
                $unitCommand->setVillage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BuildingCommand[]
     */
    public function getBuildingCommands(): Collection
    {
        return $this->buildingCommands;
    }

    public function addBuildingCommand(BuildingCommand $buildingCommand): self
    {
        if (!$this->buildingCommands->contains($buildingCommand)) {
            $this->buildingCommands[] = $buildingCommand;
            $buildingCommand->setVillage($this);
        }

        return $this;
    }

    public function removeBuildingCommand(BuildingCommand $buildingCommand): self
    {
        if ($this->buildingCommands->removeElement($buildingCommand)) {
            // set the owning side to null (unless already changed)
            if ($buildingCommand->getVillage() === $this) {
                $buildingCommand->setVillage(null);
            }
        }

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
     * @return PlayerVillage
     */
    public function setName(string $name): PlayerVillage
    {
        $this->name = $name;
        return $this;
    }
}
