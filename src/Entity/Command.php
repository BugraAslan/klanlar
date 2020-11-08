<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Command
 *
 * @ORM\Table(name="command", indexes={
 *     @ORM\Index(name="command_command_type_id_fk", columns={"command_type_id"}),
 *     @ORM\Index(name="command_player_id_fk", columns={"target_player_id"}),
 *     @ORM\Index(name="command_player_id_fk_2", columns={"source_player_id"}),
 *     @ORM\Index(name="command_player_village_id_fk_", columns={"source_player_id"}),
 *     @ORM\Index(name="command_player_village_id_fk_2", columns={"target_player_id"})
 * })
 *
 * @ORM\Entity
 */
class Command
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
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source_village_id", referencedColumnName="id")
     * })
     */
    private $sourceVillage;

    /**
     * @var PlayerVillage
     *
     * @ORM\ManyToOne(targetEntity="PlayerVillage", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_village_id", referencedColumnName="id")
     * })
     */
    private $targetVillage;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="arrival_date", type="datetime", nullable=true)
     */
    private $arrivalDate;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="return_date", type="datetime", nullable=true)
     */
    private $returnDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_arrival", type="boolean", nullable=false)
     */
    private $isArrival = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="is_return", type="boolean", nullable=false)
     */
    private $isReturn = '0';

    /**
     * @var CommandType
     *
     * @ORM\ManyToOne(targetEntity="CommandType", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="command_type_id", referencedColumnName="id")
     * })
     */
    private $commandType;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target_player_id", referencedColumnName="id")
     * })
     */
    private $targetPlayer;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source_player_id", referencedColumnName="id")
     * })
     */
    private $sourcePlayer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CommandUnit", mappedBy="command")
     */
    private $commandUnits;

    /**
     * Command constructor.
     */
    public function __construct()
    {
        $this->commandUnits = new ArrayCollection();
    }

    /**
     * @return Collection|CommandUnit[]
     */
    public function getCommandUnits(): Collection
    {
        return $this->commandUnits;
    }

    public function addCommandUnit(CommandUnit $commandUnit): self
    {
        if (!$this->commandUnits->contains($commandUnit)) {
            $this->commandUnits[] = $commandUnit;
            $commandUnit->setCommand($this);
        }

        return $this;
    }

    public function removeCommandUnit(CommandUnit $commandUnit): self
    {
        if ($this->commandUnits->removeElement($commandUnit)) {
            // set the owning side to null (unless already changed)
            if ($commandUnit->getCommand() === $this) {
                $commandUnit->setCommand(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArrivalDate(): ?\DateTimeInterface
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(?\DateTimeInterface $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getIsArrival(): ?bool
    {
        return $this->isArrival;
    }

    public function setIsArrival(bool $isArrival): self
    {
        $this->isArrival = $isArrival;

        return $this;
    }

    public function getIsReturn(): ?bool
    {
        return $this->isReturn;
    }

    public function setIsReturn(bool $isReturn): self
    {
        $this->isReturn = $isReturn;

        return $this;
    }

    public function getSourceVillage(): ?PlayerVillage
    {
        return $this->sourceVillage;
    }

    public function setSourceVillage(?PlayerVillage $sourceVillage): self
    {
        $this->sourceVillage = $sourceVillage;

        return $this;
    }

    public function getTargetVillage(): ?PlayerVillage
    {
        return $this->targetVillage;
    }

    public function setTargetVillage(?PlayerVillage $targetVillage): self
    {
        $this->targetVillage = $targetVillage;

        return $this;
    }

    public function getCommandType(): ?CommandType
    {
        return $this->commandType;
    }

    public function setCommandType(?CommandType $commandType): self
    {
        $this->commandType = $commandType;

        return $this;
    }

    public function getTargetPlayer(): ?Player
    {
        return $this->targetPlayer;
    }

    public function setTargetPlayer(?Player $targetPlayer): self
    {
        $this->targetPlayer = $targetPlayer;

        return $this;
    }

    public function getSourcePlayer(): ?Player
    {
        return $this->sourcePlayer;
    }

    public function setSourcePlayer(?Player $sourcePlayer): self
    {
        $this->sourcePlayer = $sourcePlayer;

        return $this;
    }
}
