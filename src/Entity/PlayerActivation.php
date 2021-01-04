<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerActivation
 *
 * @ORM\Table(name="player_activation", indexes={@ORM\Index(name="player_activation_player_id_fk", columns={"player_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PlayerActivationRepository")
 */
class PlayerActivation
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
     * @var DateTime|null
     *
     * @ORM\Column(name="request_date", type="datetime", nullable=true)
     */
    private $requestDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="activation_code", type="string", length=6, nullable=true)
     */
    private $activationCode = '';

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="activation_date", type="datetime", nullable=true)
     */
    private $activationDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive = '0';

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTime|null
     */
    public function getRequestDate(): ?DateTime
    {
        return $this->requestDate;
    }

    /**
     * @param DateTime|null $requestDate
     * @return PlayerActivation
     */
    public function setRequestDate(?DateTime $requestDate): PlayerActivation
    {
        $this->requestDate = $requestDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivationCode(): ?string
    {
        return $this->activationCode;
    }

    /**
     * @param string|null $activationCode
     * @return PlayerActivation
     */
    public function setActivationCode(?string $activationCode): PlayerActivation
    {
        $this->activationCode = $activationCode;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getActivationDate(): ?DateTime
    {
        return $this->activationDate;
    }

    /**
     * @param DateTime|null $activationDate
     * @return PlayerActivation
     */
    public function setActivationDate(?DateTime $activationDate): PlayerActivation
    {
        $this->activationDate = $activationDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return PlayerActivation
     */
    public function setIsActive(bool $isActive): PlayerActivation
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
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
}
