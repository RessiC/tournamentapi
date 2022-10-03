<?php

namespace App\Entity\User;

use App\Entity\Team;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private bool $isConfirmed = false;

    #[ORM\Column]
    private bool $isPlayer = false;

    #[ORM\Column(length: 180, unique: true)]
    private string $gamerTag;

    #[ORM\Column]
    private bool $isCaptain = false;

    #[ORM\Column]
    private int $points = 0;

    #[ORM\ManyToOne(inversedBy: 'players')]
    private ?Team $team = null;

    public function __construct()
    {
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->isConfirmed;
    }

    /**
     * @param bool $isConfirmed
     * @return User
     */
    public function setIsConfirmed(bool $isConfirmed): User
    {
        $this->isConfirmed = $isConfirmed;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPlayer(): bool
    {
        return $this->isPlayer;
    }

    /**
     * @param bool $isPlayer
     * @return User
     */
    public function setIsPlayer(bool $isPlayer): User
    {
        $this->isPlayer = $isPlayer;
        return $this;
    }

    /**
     * @return string
     */
    public function getGamerTag(): string
    {
        return $this->gamerTag;
    }

    /**
     * @param string $gamerTag
     * @return User
     */
    public function setGamerTag(string $gamerTag): User
    {
        $this->gamerTag = $gamerTag;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCaptain(): bool
    {
        return $this->isCaptain;
    }

    /**
     * @param bool $isCaptain
     * @return User
     */
    public function setIsCaptain(bool $isCaptain): User
    {
        $this->isCaptain = $isCaptain;
        return $this;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     * @return User
     */
    public function setPoints(int $points): User
    {
        $this->points = $points;
        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}
