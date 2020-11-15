<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity
 */
class Unit
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
     * @ORM\Column(name="time_per_area", type="smallint", nullable=true)
     */
    private $timePerArea;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost_per_wood", type="integer", nullable=true)
     */
    private $costPerWood;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost_per_clay", type="integer", nullable=true)
     */
    private $costPerClay;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost_per_iron", type="integer", nullable=true)
     */
    private $costPerIron;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cost_per_population", type="smallint", nullable=true)
     */
    private $costPerPopulation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="per_carrying_capacity", type="smallint", nullable=true)
     */
    private $perCarryingCapacity;

    /**
     * @var int|null
     *
     * @ORM\Column(name="attack_force", type="smallint", nullable=true)
     */
    private $attackForce;

    /**
     * @var int|null
     *
     * @ORM\Column(name="general_defense_force", type="smallint", nullable=true)
     */
    private $generalDefenseForce;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cavalry_defense_force", type="smallint", nullable=true)
     */
    private $cavalryDefenseForce;

    /**
     * @var int|null
     *
     * @ORM\Column(name="base_build_time", type="smallint", nullable=true)
     */
    private $baseBuildTime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="base_icon", type="string", length=255, nullable=true)
     */
    private $baseIcon;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTimePerArea(): ?int
    {
        return $this->timePerArea;
    }

    public function setTimePerArea(?int $timePerArea): self
    {
        $this->timePerArea = $timePerArea;

        return $this;
    }

    public function getCostPerWood(): ?int
    {
        return $this->costPerWood;
    }

    public function setCostPerWood(?int $costPerWood): self
    {
        $this->costPerWood = $costPerWood;

        return $this;
    }

    public function getCostPerClay(): ?int
    {
        return $this->costPerClay;
    }

    public function setCostPerClay(?int $costPerClay): self
    {
        $this->costPerClay = $costPerClay;

        return $this;
    }

    public function getCostPerIron(): ?int
    {
        return $this->costPerIron;
    }

    public function setCostPerIron(?int $costPerIron): self
    {
        $this->costPerIron = $costPerIron;

        return $this;
    }

    public function getCostPerPopulation(): ?int
    {
        return $this->costPerPopulation;
    }

    public function setCostPerPopulation(?int $costPerPopulation): self
    {
        $this->costPerPopulation = $costPerPopulation;

        return $this;
    }

    public function getPerCarryingCapacity(): ?int
    {
        return $this->perCarryingCapacity;
    }

    public function setPerCarryingCapacity(?int $perCarryingCapacity): self
    {
        $this->perCarryingCapacity = $perCarryingCapacity;

        return $this;
    }

    public function getAttackForce(): ?int
    {
        return $this->attackForce;
    }

    public function setAttackForce(?int $attackForce): self
    {
        $this->attackForce = $attackForce;

        return $this;
    }

    public function getGeneralDefenseForce(): ?int
    {
        return $this->generalDefenseForce;
    }

    public function setGeneralDefenseForce(?int $generalDefenseForce): self
    {
        $this->generalDefenseForce = $generalDefenseForce;

        return $this;
    }

    public function getCavalryDefenseForce(): ?int
    {
        return $this->cavalryDefenseForce;
    }

    public function setCavalryDefenseForce(?int $cavalryDefenseForce): self
    {
        $this->cavalryDefenseForce = $cavalryDefenseForce;

        return $this;
    }

    public function getBaseBuildTime(): ?int
    {
        return $this->baseBuildTime;
    }

    public function setBaseBuildTime(?int $baseBuildTime): self
    {
        $this->baseBuildTime = $baseBuildTime;

        return $this;
    }

    public function getBaseIcon(): ?string
    {
        return $this->baseIcon;
    }

    public function setBaseIcon(?string $baseIcon): self
    {
        $this->baseIcon = $baseIcon;
        return $this;
    }
}
