<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * UnitCommand
 *
 * @ORM\Table(name="unit_command", indexes={
 *     @ORM\Index(name="unit_command_unit_id_fk", columns={"unit_id"}),
 *     @ORM\Index(name="unit_command_village_id_fk", columns={"village_id"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\UnitCommandRepository")
 */
class UnitCommand
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
     * @var int
     *
     * @ORM\Column(name="command_count", type="smallint", options={"unsigned"=true})
     */
    private $commandCount;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="start_date", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $startDate = 'CURRENT_TIMESTAMP';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_wood", type="smallint", options={"unsigned"=true})
     */
    private $costWood;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_clay", type="smallint", options={"unsigned"=true})
     */
    private $costClay;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_iron", type="smallint", options={"unsigned"=true})
     */
    private $costIron;

    /**
     * @var int
     *
     * @ORM\Column(name="cost_population", type="smallint", options={"unsigned"=true})
     */
    private $costPopulation;

    /**
     * @var Unit
     *
     * @ORM\ManyToOne(targetEntity="Unit", inversedBy="commands")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="unitCommands")
     * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
     */
    private $village;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_finished", type="boolean", options={"default"=false})
     */
    private $isFinished = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCommandCount(): ?int
    {
        return $this->commandCount;
    }

    public function setCommandCount(int $commandCount): self
    {
        $this->commandCount = $commandCount;

        return $this;
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

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

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

    public function IsFinished(): bool
    {
        return $this->isFinished;
    }

    public function setFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }
}
