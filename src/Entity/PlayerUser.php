<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class PlayerUser extends User
{
    public const ROLE = ['ROLE_PLAYER'];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private string $gamertTag;

    #[ORM\Column]
    private bool $isCaptain = false;


    public function __construct(User $user)
    {
        parent::__construct();
        $this->copyUser($user);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGamertTag(): string
    {
        return $this->gamertTag;
    }

    /**
     * @param string $gamertTag
     * @return PlayerUser
     */
    public function setGamertTag(string $gamertTag): PlayerUser
    {
        $this->gamertTag = $gamertTag;
        return $this;
    }

    public function getIsCaptain(): bool
    {
        return $this->isCaptain;
    }

    public function setIsCaptain(bool $isCaptain): self
    {
        $this->isCaptain = $isCaptain;

        return $this;
    }

    private function copyUser(User $user)
    {
        $this->setPassword($user->getPassword());
        $this->setEmail($user->getEmail());
    }
}
