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

    #[ORM\Column(nullable: true)]
    private ?int $cashPrice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $linkTwitch = null;

    #[ORM\Column]
    private \DateTime $createdAt;

    #[ORM\Column]
    private \DateTime $startAt;

    #[ORM\Column]
    private ?int $points = null;

    #[ORM\Column]
    private ?int $TeamsNeeded = null;

    #[ORM\Column]
    private ?bool $BracketLooser = null;

    #[ORM\OneToMany(mappedBy: 'tournament', targetEntity: Game::class, cascade: ["persist", "remove"])]
    private ?Collection $games = null;


    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'tournaments', cascade: ["persist"])]
    private ?Collection $teams = null;


    public function __construct()
    {
        $this->teams = new ArrayCollection();
        $this->createdAt = new \DateTime();
        $this->games = new ArrayCollection();
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
     * @return Collection|Null
     */
    public function getTeams(): Collection|Null
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStartAt(): ?\DateTime
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTime $startAt): self
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

    public function getGames(): Collection|null
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games->add($game);
            $game->setTournament($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getTournament() === $this) {
                $game->setTournament(null);
            }
        }

        return $this;
    }

    public function getTeamsNeeded(): ?int
    {
        return $this->TeamsNeeded;
    }

    public function setTeamsNeeded(int $TeamsNeeded): self
    {
        $this->TeamsNeeded = $TeamsNeeded;

        return $this;
    }

    public function isBracketLooser(): ?bool
    {
        return $this->BracketLooser;
    }

    public function setBracketLooser(bool $BracketLooser): self
    {
        $this->BracketLooser = $BracketLooser;

        return $this;
    }

}
