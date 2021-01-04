<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerProfile
 *
 * @ORM\Table(name="player_profile", indexes={@ORM\Index(name="player_profile_player_id_fk", columns={"player_id"})})
 * @ORM\Entity
 */
class PlayerProfile
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
     * @var int|null
     *
     * @ORM\Column(name="age", type="smallint", nullable=true)
     */
    private $age;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sex", type="string", length=10, nullable=true)
     */
    private $sex;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="profile")
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     */
    private $player;

    /**
     * @var int
     *
     * @ORM\Column(name="world_id", type="integer", options={"unsigned"=true})
     */
    private $worldId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar_url", type="string", length=500, nullable=true)
     */
    private $avatarUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(?string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    /**
     * @return int
     */
    public function getWorldId(): int
    {
        return $this->worldId;
    }

    /**
     * @param int $worldId
     * @return PlayerProfile
     */
    public function setWorldId(int $worldId): PlayerProfile
    {
        $this->worldId = $worldId;
        return $this;
    }

    public function getAvatarUrl(): ?string
    {
        return $this->avatarUrl;
    }

    public function setAvatarUrl(?string $avatarUrl): self
    {
        $this->avatarUrl = $avatarUrl;
        return $this;
    }
}
