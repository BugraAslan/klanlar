<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * BuildingCommand
 *
 * @ORM\Table(name="building_command", indexes={
 *     @ORM\Index(name="building_command_building_id_fk", columns={"building_id"}),
 *     @ORM\Index(name="building_command_village_id_fk", columns={"village_id"})
 * })
 *
 * @ORM\Entity
 */
class BuildingCommand
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
     * @var DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $startDate = 'CURRENT_TIMESTAMP';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_date", type="datetime", nullable=false)
     */
    private $endDate;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="remaining_time", type="time", nullable=false)
     */
    private $remainingTime;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_wood", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $costWood;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_clay", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $costClay;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_iron", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $costIron;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_population", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $costPopulation;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_finished", type="boolean", nullable=false)
     */
    private $isFinished = false;

    /**
     * @var Building
     *
     * @ORM\ManyToOne(targetEntity="Building", inversedBy="commands")
     * @ORM\JoinColumn(name="building_id", referencedColumnName="id")
     */
    private $building;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="buildingCommands")
     * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     */
    private $village;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getRemainingTime(): ?\DateTimeInterface
    {
        return $this->remainingTime;
    }

    public function setRemainingTime(\DateTimeInterface $remainingTime): self
    {
        $this->remainingTime = $remainingTime;

        return $this;
    }

    public function getCostWood(): ?int
    {
        return $this->costWood;
    }

    public function setCostWood(int $costWood): self
    {
        $this->costWood = $costWood;

        return $this;
    }

    public function getCostClay(): ?int
    {
        return $this->costClay;
    }

    public function setCostClay(int $costClay): self
    {
        $this->costClay = $costClay;

        return $this;
    }

    public function getCostIron(): ?int
    {
        return $this->costIron;
    }

    public function setCostIron(int $costIron): self
    {
        $this->costIron = $costIron;

        return $this;
    }

    public function getCostPopulation(): ?int
    {
        return $this->costPopulation;
    }

    public function setCostPopulation(int $costPopulation): self
    {
        $this->costPopulation = $costPopulation;

        return $this;
    }

    public function IsFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

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
