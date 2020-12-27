<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerNotification
 *
 * @ORM\Table(name="player_notification", indexes={@ORM\Index(name="player_notification_player_id_fk", columns={"player_id"})})
 * @ORM\Entity
 */
class PlayerNotification
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
     * @ORM\Column(name="build_notification", type="boolean", nullable=false, options={"default"="1"})
     */
    private $buildNotification = true;

    /**
     * @var bool
     *
     * @ORM\Column(name="message_notification", type="boolean", nullable=false, options={"default"="1"})
     */
    private $messageNotification = true;

    /**
     * @var Player
     *
     * @ORM\OneToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildNotification(): ?bool
    {
        return $this->buildNotification;
    }

    public function setBuildNotification(bool $buildNotification): self
    {
        $this->buildNotification = $buildNotification;

        return $this;
    }

    public function getMessageNotification(): ?bool
    {
        return $this->messageNotification;
    }

    public function setMessageNotification(bool $messageNotification): self
    {
        $this->messageNotification = $messageNotification;

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
}
