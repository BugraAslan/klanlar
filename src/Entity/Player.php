<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Player
 *
 * @ORM\Table(name="player")
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player implements UserInterface
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=20, nullable=false)
     */
    private $username = '';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password = '';

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="premium", type="integer", nullable=true)
     */
    private $premium = '0';

    /**
     * @var DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdDate = 'CURRENT_TIMESTAMP';

    /**
     * @ORM\OneToMany(targetEntity="PlayerVillage", mappedBy="player")
     */
    private $villages;

    /**
     * @ORM\OneToMany(targetEntity="Command", mappedBy="targetPlayer")
     */
    private $commandTargetPlayers;

    /**
     * @ORM\OneToMany(targetEntity="Command", mappedBy="sourcePlayer")
     */
    private $commandSourcePlayers;

    /**
     * @ORM\OneToOne(targetEntity="PlayerActivation", mappedBy="player")
     */
    private $activation;

    /**
     * @ORM\OneToOne(targetEntity="PlayerProfile", mappedBy="player")
     */
    private $profile;

    /**
     * @ORM\OneToMany(targetEntity="PlayerWorld", mappedBy="player")
     */
    private $worlds;

    /** @var string|null */
    public $apiToken;

    /**
     * Player constructor.
     */
    public function __construct()
    {
        $this->villages = new ArrayCollection();
        $this->commandTargetPlayers = new ArrayCollection();
        $this->commandSourcePlayers = new ArrayCollection();
        $this->worlds = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Player
     */
    public function setUsername(string $username): Player
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Player
     */
    public function setPassword(string $password): Player
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Player
     */
    public function setEmail(string $email): Player
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPremium(): ?int
    {
        return $this->premium;
    }

    /**
     * @param int|null $premium
     * @return Player
     */
    public function setPremium(?int $premium): Player
    {
        $this->premium = $premium;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedDate(): DateTime
    {
        return $this->createdDate;
    }

    /**
     * @param DateTime $createdDate
     * @return Player
     */
    public function setCreatedDate(DateTime $createdDate): Player
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return Collection|PlayerVillage[]
     */
    public function getVillages(): Collection
    {
        return $this->villages;
    }

    public function addVillage(PlayerVillage $playerVillage): self
    {
        if (!$this->villages->contains($playerVillage)) {
            $this->villages[] = $playerVillage;
            $playerVillage->setPlayer($this);
        }

        return $this;
    }

    public function removeVillage(PlayerVillage $playerVillage): self
    {
        if ($this->villages->removeElement($playerVillage)) {
            // set the owning side to null (unless already changed)
            if ($playerVillage->getPlayer() === $this) {
                $playerVillage->setPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommandTargetPlayers(): Collection
    {
        return $this->commandTargetPlayers;
    }

    public function addCommandTargetPlayer(Command $commandTargetPlayer): self
    {
        if (!$this->commandTargetPlayers->contains($commandTargetPlayer)) {
            $this->commandTargetPlayers[] = $commandTargetPlayer;
            $commandTargetPlayer->setTargetPlayer($this);
        }

        return $this;
    }

    public function removeCommandTargetPlayer(Command $commandTargetPlayer): self
    {
        if ($this->commandTargetPlayers->removeElement($commandTargetPlayer)) {
            // set the owning side to null (unless already changed)
            if ($commandTargetPlayer->getTargetPlayer() === $this) {
                $commandTargetPlayer->setTargetPlayer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Command[]
     */
    public function getCommandSourcePlayers(): Collection
    {
        return $this->commandSourcePlayers;
    }

    public function addCommandSourcePlayer(Command $commandSourcePlayer): self
    {
        if (!$this->commandSourcePlayers->contains($commandSourcePlayer)) {
            $this->commandSourcePlayers[] = $commandSourcePlayer;
            $commandSourcePlayer->setSourcePlayer($this);
        }

        return $this;
    }

    public function removeCommandSourcePlayer(Command $commandSourcePlayer): self
    {
        if ($this->commandSourcePlayers->removeElement($commandSourcePlayer)) {
            // set the owning side to null (unless already changed)
            if ($commandSourcePlayer->getSourcePlayer() === $this) {
                $commandSourcePlayer->setSourcePlayer(null);
            }
        }

        return $this;
    }

    public function getActivation(): ?PlayerActivation
    {
        return $this->activation;
    }

    public function setActivation(?PlayerActivation $playerActivation): self
    {
        $this->activation = $playerActivation;

        // set (or unset) the owning side of the relation if necessary
        $newPlayer = null === $playerActivation ? null : $this;
        if ($playerActivation->getPlayer() !== $newPlayer) {
            $playerActivation->setPlayer($newPlayer);
        }

        return $this;
    }

    public function getProfile(): ?PlayerProfile
    {
        return $this->profile;
    }

    public function setProfile(?PlayerProfile $playerProfile): self
    {
        $this->profile = $playerProfile;

        // set (or unset) the owning side of the relation if necessary
        $newPlayer = null === $playerProfile ? null : $this;
        if ($playerProfile->getPlayer() !== $newPlayer) {
            $playerProfile->setPlayer($newPlayer);
        }

        return $this;
    }

    /**
     * @return Collection|PlayerWorld[]
     */
    public function getWorlds(): Collection
    {
        return $this->worlds;
    }

    public function addWorld(PlayerWorld $playerWorld): self
    {
        if (!$this->worlds->contains($playerWorld)) {
            $this->worlds[] = $playerWorld;
            $playerWorld->setPlayer($this);
        }

        return $this;
    }

    public function removeWorld(PlayerWorld $playerWorld): self
    {
        if ($this->worlds->removeElement($playerWorld)) {
            // set the owning side to null (unless already changed)
            if ($playerWorld->getPlayer() === $this) {
                $playerWorld->setPlayer(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        return true;
    }

    /**
     * @return string|null
     */
    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    /**
     * @param string|null $apiToken
     * @return Player
     */
    public function setApiToken(?string $apiToken): Player
    {
        $this->apiToken = $apiToken;
        return $this;
    }
}
