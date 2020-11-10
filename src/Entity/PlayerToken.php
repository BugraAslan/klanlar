<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * PlayerToken
 *
 * @ORM\Table(name="player_token", indexes={@ORM\Index(name="player_token_player_id_fk", columns={"player_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\PlayerTokenRepository")
 */
class PlayerToken
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
     * @var string|null
     *
     * @ORM\Column(name="access_token", type="string", length=512, nullable=true)
     */
    private $accessToken;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refresh_token", type="string", length=255, nullable=true)
     */
    private $refreshToken;

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=true)
     */
    private $expireDate;

    /**
     * @var Player
     *
     * @ORM\ManyToOne(targetEntity="Player", inversedBy="id")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="player_id", referencedColumnName="id")
     * })
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
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param string|null $accessToken
     * @return PlayerToken
     */
    public function setAccessToken(?string $accessToken): PlayerToken
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * @param string|null $refreshToken
     * @return PlayerToken
     */
    public function setRefreshToken(?string $refreshToken): PlayerToken
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getExpireDate(): ?DateTime
    {
        return $this->expireDate;
    }

    /**
     * @param DateTime|null $expireDate
     * @return PlayerToken
     */
    public function setExpireDate(?DateTime $expireDate): PlayerToken
    {
        $this->expireDate = $expireDate;
        return $this;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @param Player $player
     * @return PlayerToken
     */
    public function setPlayer(Player $player): PlayerToken
    {
        $this->player = $player;
        return $this;
    }
}
