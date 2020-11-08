<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

// TODO playerId foreign key

/**
 * PlayerWorld
 *
 * @ORM\Table(name="player_world")
 * @ORM\Entity
 */
class PlayerWorld
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
     * @ORM\Column(name="player_id", type="integer", nullable=false)
     */
    private $playerId;

    /**
     * @var int
     *
     * @ORM\Column(name="world_id", type="integer", nullable=false)
     */
    private $worldId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayerId(): ?int
    {
        return $this->playerId;
    }

    public function setPlayerId(int $playerId): self
    {
        $this->playerId = $playerId;

        return $this;
    }

    public function getWorldId(): ?int
    {
        return $this->worldId;
    }

    public function setWorldId(int $worldId): self
    {
        $this->worldId = $worldId;

        return $this;
    }
}
