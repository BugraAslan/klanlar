<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Building
 *
 * @ORM\Table(name="building")
 * @ORM\Entity(repositoryClass="App\Repository\BuildingRepository")
 */
class Building
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=55, nullable=false)
     */
    private $name = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="min_level", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $minLevel = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="max_level", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $maxLevel = '0';

    /**
     * @var float|null
     *
     * @ORM\Column(name="population_factor", type="float", precision=10, scale=2, nullable=true, options={"default"="1"})
     */
    private $populationFactor = '1';

    /**
     * @var float|null
     *
     * @ORM\Column(name="wood_factor", type="float", precision=10, scale=2, nullable=true, options={"default"="1"})
     */
    private $woodFactor = '1';

    /**
     * @var float|null
     *
     * @ORM\Column(name="clay_factor", type="float", precision=10, scale=2, nullable=true, options={"default"="1"})
     */
    private $clayFactor = '1';

    /**
     * @var float|null
     *
     * @ORM\Column(name="iron_factor", type="float", precision=10, scale=2, nullable=true, options={"default"="1"})
     */
    private $ironFactor = '1';

    /**
     * @var float|null
     *
     * @ORM\Column(name="time_factor", type="float", precision=10, scale=2, nullable=true, options={"default"="1"})
     */
    private $timeFactor = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="base_build_time", type="integer", nullable=true, options={"default"="1"})
     */
    private $baseBuildTime = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="wood_cost", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $woodCost;

    /**
     * @var int|null
     *
     * @ORM\Column(name="clay_cost", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $clayCost;

    /**
     * @var int|null
     *
     * @ORM\Column(name="iron_cost", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $ironCost;

    /**
     * @var int|null
     *
     * @ORM\Column(name="population_cost", type="smallint", nullable=true, options={"unsigned"=true})
     */
    private $populationCost;

    /**
     * @ORM\OneToMany(targetEntity="BuildingRequirements", mappedBy="building")
     */
    private $buildingRequirements;

    /**
     * @ORM\OneToMany(targetEntity="UnitManufacturer", mappedBy="building")
     */
    private $unitManufacturers;

    /**
     * @ORM\OneToOne(targetEntity="BuildingDescription", mappedBy="building")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="BuildingIcon", mappedBy="building")
     */
    private $icons;

    public function __construct()
    {
        $this->buildingRequirements = new ArrayCollection();
        $this->unitManufacturers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return Building
     */
    public function setName(string $name): Building
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinLevel(): ?int
    {
        return $this->minLevel;
    }

    /**
     * @param int|null $minLevel
     * @return Building
     */
    public function setMinLevel(?int $minLevel): Building
    {
        $this->minLevel = $minLevel;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxLevel(): ?int
    {
        return $this->maxLevel;
    }

    /**
     * @param int|null $maxLevel
     * @return Building
     */
    public function setMaxLevel(?int $maxLevel): Building
    {
        $this->maxLevel = $maxLevel;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPopulationFactor(): ?float
    {
        return $this->populationFactor;
    }

    /**
     * @param float|null $populationFactor
     * @return Building
     */
    public function setPopulationFactor(?float $populationFactor): Building
    {
        $this->populationFactor = $populationFactor;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getWoodFactor(): ?float
    {
        return $this->woodFactor;
    }

    /**
     * @param float|null $woodFactor
     * @return Building
     */
    public function setWoodFactor(?float $woodFactor): Building
    {
        $this->woodFactor = $woodFactor;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getClayFactor(): ?float
    {
        return $this->clayFactor;
    }

    /**
     * @param float|null $clayFactor
     * @return Building
     */
    public function setClayFactor(?float $clayFactor): Building
    {
        $this->clayFactor = $clayFactor;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getIronFactor(): ?float
    {
        return $this->ironFactor;
    }

    /**
     * @param float|null $ironFactor
     * @return Building
     */
    public function setIronFactor(?float $ironFactor): Building
    {
        $this->ironFactor = $ironFactor;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTimeFactor(): ?float
    {
        return $this->timeFactor;
    }

    /**
     * @param float|null $timeFactor
     * @return Building
     */
    public function setTimeFactor(?float $timeFactor): Building
    {
        $this->timeFactor = $timeFactor;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBaseBuildTime(): ?int
    {
        return $this->baseBuildTime;
    }

    /**
     * @param int|null $baseBuildTime
     * @return Building
     */
    public function setBaseBuildTime(?int $baseBuildTime): Building
    {
        $this->baseBuildTime = $baseBuildTime;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getWoodCost(): ?int
    {
        return $this->woodCost;
    }

    /**
     * @param int|null $woodCost
     * @return Building
     */
    public function setWoodCost(?int $woodCost): Building
    {
        $this->woodCost = $woodCost;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getClayCost(): ?int
    {
        return $this->clayCost;
    }

    /**
     * @param int|null $clayCost
     * @return Building
     */
    public function setClayCost(?int $clayCost): Building
    {
        $this->clayCost = $clayCost;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getIronCost(): ?int
    {
        return $this->ironCost;
    }

    /**
     * @param int|null $ironCost
     * @return Building
     */
    public function setIronCost(?int $ironCost): Building
    {
        $this->ironCost = $ironCost;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPopulationCost(): ?int
    {
        return $this->populationCost;
    }

    /**
     * @param int|null $populationCost
     * @return Building
     */
    public function setPopulationCost(?int $populationCost): Building
    {
        $this->populationCost = $populationCost;
        return $this;
    }

    /**
     * @return Collection|BuildingRequirements[]
     */
    public function getBuildingRequirements(): Collection
    {
        return $this->buildingRequirements;
    }

    public function addBuildingRequirement(BuildingRequirements $buildingRequirement): self
    {
        if (!$this->buildingRequirements->contains($buildingRequirement)) {
            $this->buildingRequirements[] = $buildingRequirement;
            $buildingRequirement->setBuilding($this);
        }

        return $this;
    }

    public function removeBuildingRequirement(BuildingRequirements $buildingRequirement): self
    {
        if ($this->buildingRequirements->removeElement($buildingRequirement)) {
            // set the owning side to null (unless already changed)
            if ($buildingRequirement->getBuilding() === $this) {
                $buildingRequirement->setBuilding(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UnitManufacturer[]
     */
    public function getUnitManufacturers(): Collection
    {
        return $this->unitManufacturers;
    }

    public function addUnitManufacturer(UnitManufacturer $unitManufacturer): self
    {
        if (!$this->unitManufacturers->contains($unitManufacturer)) {
            $this->unitManufacturers[] = $unitManufacturer;
            $unitManufacturer->setBuilding($this);
        }

        return $this;
    }

    public function removeUnitManufacturer(UnitManufacturer $unitManufacturer): self
    {
        if ($this->unitManufacturers->removeElement($unitManufacturer)) {
            // set the owning side to null (unless already changed)
            if ($unitManufacturer->getBuilding() === $this) {
                $unitManufacturer->setBuilding(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?BuildingDescription
    {
        return $this->description;
    }

    public function setDescription(?BuildingDescription $description): self
    {
        $this->description = $description;

        // set (or unset) the owning side of the relation if necessary
        $newBuilding = null === $description ? null : $this;
        if ($description->getBuilding() !== $newBuilding) {
            $description->setBuilding($newBuilding);
        }

        return $this;
    }

    public function getIcons(): ?BuildingIcon
    {
        return $this->icons;
    }

    public function setIcons(?BuildingIcon $icons): self
    {
        $this->icons = $icons;

        // set (or unset) the owning side of the relation if necessary
        $newBuilding = null === $icons ? null : $this;
        if ($icons->getBuilding() !== $newBuilding) {
            $icons->setBuilding($newBuilding);
        }

        return $this;
    }
}
