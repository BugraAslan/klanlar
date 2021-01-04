<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerWorld
 *
 * @ORM\Table(name="player_world", indexes={
 *     @ORM\Index(name="player_world_player_id_fk", columns={"player_id"}),
 *     @ORM\Index(name="player_world_world_id_fk", columns={"world_id"})
 * })
 * @ORM\Entity(repositoryClass="App\Repository\PlayerWorldRepository")
 */
class PlayerWorld
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
     * @var Player|null
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="worlds")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @var World|null
     *
     * @ORM\ManyToOne(targetEntity="World")
     * @ORM\JoinColumn(name="world_id", referencedColumnName="id")
     */
    private $world;

    public function getId(): int
    {
        return $this->id;
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

    public function getWorld(): ?World
    {
        return $this->world;
    }

    public function setWorld(?World $world): self
    {
        $this->world = $world;

        return $this;
    }
}
