<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandUnit
 *
 * @ORM\Table(name="command_unit", indexes={@ORM\Index(name="command_unit_command_id_fk", columns={"command_id"})})
 * @ORM\Entity
 */
class CommandUnit
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
     * @ORM\Column(name="unit_count", type="integer", nullable=false)
     */
    private $unitCount = '0';

    /**
     * @var Command
     *
     * @ORM\ManyToOne(targetEntity="Command", inversedBy="commandUnits")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     * })
     */
    private $command;

    /**
     * @var Unit|null
     *
     * @ORM\OneToOne(targetEntity="Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
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
     * @return CommandUnit
     */
    public function setUnit(?Unit $unit): CommandUnit
    {
        $this->unit = $unit;
        return $this;
    }
}
