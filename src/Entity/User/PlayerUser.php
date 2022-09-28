<?php

namespace App\Entity\User;

use App\Repository\PlayerUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerUserRepository::class)]

class PlayerUser extends User
{
    public const ROLE = ['ROLE_PLAYER'];

    #[ORM\Column(length: 180, unique: true)]
    private string $gamerTag;

    #[ORM\Column]
    private bool $isCaptain = false;

    #[ORM\Column]
    private int $points = 0;

    public function __construct(User $user)
    {
        parent::__construct();
        $this->copyUser($user);
    }

    public function getGamerTag(): string
    {
        return $this->gamerTag;
    }

    public function setGamerTag(string $gamerTag): PlayerUser
    {
        $this->gamerTag = $gamerTag;
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

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): PlayerUser
    {
        $this->points = $points;
        return $this;
    }

    private function copyUser(User $user)
    {
        $this->setPassword($user->getPassword());
        $this->setEmail($user->getEmail());
        $this->setRoles(['ROLE_PLAYER']);
    }

}
