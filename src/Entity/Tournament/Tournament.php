<?php

namespace App\Entity\Tournament;

use App\Entity\Team\Team;
use App\Repository\TournamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TournamentRepository::class)]
class Tournament
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private string $name;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'tournaments')]
    private Collection $teams;

    #[ORM\Column(nullable: true)]
    private ?int $cashPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkTwitch = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column(length: 10)]
    private ?string $type = null;

    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable("now");
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        $this->teams->removeElement($team);

        return $this;
    }

    public function getCashPrice(): ?int
    {
        return $this->cashPrice;
    }

    public function setCashPrice(?int $cashPrice): self
    {
        $this->cashPrice = $cashPrice;

        return $this;
    }

    public function getLinkTwitch(): ?string
    {
        return $this->linkTwitch;
    }

    public function setLinkTwitch(?string $linkTwitch): self
    {
        $this->linkTwitch = $linkTwitch;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
