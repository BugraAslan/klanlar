<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerDetail
 *
 * @ORM\Table(name="player_detail", indexes={@ORM\Index(name="player_detail_player_id_fk", columns={"player_id"})})
 * @ORM\Entity
 */
class PlayerDetail
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
     * @var bool
     *
     * @ORM\Column(name="email_activation", type="boolean", nullable=false)
     */
    private $emailActivation = '0';

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="last_login_date", type="datetime", nullable=true)
     */
    private $lastLoginDate;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="last_active_date", type="datetime", nullable=true)
     */
    private $lastActiveDate;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player", inversedBy="playerDetail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
     */
    private $player;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailActivation(): ?bool
    {
        return $this->emailActivation;
    }

    public function setEmailActivation(bool $emailActivation): self
    {
        $this->emailActivation = $emailActivation;

        return $this;
    }

    public function getLastLoginDate(): ?\DateTimeInterface
    {
        return $this->lastLoginDate;
    }

    public function setLastLoginDate(?\DateTimeInterface $lastLoginDate): self
    {
        $this->lastLoginDate = $lastLoginDate;

        return $this;
    }

    public function getLastActiveDate(): ?\DateTimeInterface
    {
        return $this->lastActiveDate;
    }

    public function setLastActiveDate(?\DateTimeInterface $lastActiveDate): self
    {
        $this->lastActiveDate = $lastActiveDate;

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
}
