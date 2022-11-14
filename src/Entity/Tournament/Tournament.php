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
    private ?int $teamsNeeded = null;

    #[ORM\Column]
    private ?bool $bracketLooser = null;

    #[ORM\ManyToMany(targetEntity: Team::class, inversedBy: 'tournaments', cascade: ["persist"])]
    private ?Collection $teams = null;

    #[ORM\OneToMany(mappedBy: 'tournament', targetEntity: Bracket::class, orphanRemoval: true)]
    private Collection $brackets;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->teams = new ArrayCollection();
        $this->brackets = new ArrayCollection();
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

    public function getTeamsNeeded(): ?int
    {
        return $this->teamsNeeded;
    }

    public function setTeamsNeeded(int $teamsNeeded): self
    {
        $this->teamsNeeded = $teamsNeeded;

        return $this;
    }

    public function hasBracketLooser(): ?bool
    {
        return $this->bracketLooser;
    }

    public function setBracketLooser(bool $bracketLooser): self
    {
        $this->bracketLooser = $bracketLooser;

        return $this;
    }

    public function isStarted()
    {
        return true;
    }

    /**
     * @return Collection<int, Bracket>
     */
    public function getBrackets(): Collection
    {
        return $this->brackets;
    }

    public function addBracket(Bracket $bracket): self
    {
        if (!$this->brackets->contains($bracket)) {
            $this->brackets->add($bracket);
            $bracket->setTournament($this);
        }

        return $this;
    }

    public function removeBracket(Bracket $bracket): self
    {
        if ($this->brackets->removeElement($bracket)) {
            // set the owning side to null (unless already changed)
            if ($bracket->getTournament() === $this) {
                $bracket->setTournament(null);
            }
        }

        return $this;
    }

    public function initialize()
    {
//            creates winner bracket and looserBracket if needed (tournament->hasBracketLooser())
//            creates games for each bracket
//            if ($i%3 === 0) {
//               $match->setPreviousGame1($games[$-1]);
//               $match->setPreviousGame2($games[$-2]);
//            }

    }
    /**
     * @param array $teams
     * @param Tournament $tournament
     */
    public function assignTeam(array $teams, Tournament $tournament)
    {
        if ($tournament->isStarted()) {

            // assign Team in each game according to their rank ( usort team->getPoints)





        }
    }

    // $score = "3-2"
    public function inputGameResult(Game $game)
    {
        // Si team 1 qui PUT alors remplir $game->setScoreTeam1accordingToTeam1()...

        $this->checkEndMatch($game);
    }

    // une fois que les 2 teams ont rempli les scores
    public function checkEndMatch(Game $game)
    {
        if ($game->getScoreTeam1() != null && $game->getScoreTeam2() != null && $game->getScoreTeam1() === $game->getScoreTeam2())
        {
            $game->setIsFinished(true);

        }
        // si les 2 scores sont report et SI ils pareils sinon
        // isFinished => true
        // nextSteps :
        // 1. assigner le winner sur le match suivant dans la winner bracket
        // $tournament->getMatch(?)
        // 2. assigner le looser sur le match suivant dans la looser bracket
    }

}
