<?php

namespace App\Entity\Tournament;

use App\Entity\Team\Team;
use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

use function PHPUnit\Framework\throwException;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isFinished = null;

    #[ORM\ManyToOne]
    private ?Team $team1 = null;

    #[ORM\ManyToOne]
    private ?Team $team2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam1accordingToTeam1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam2accordingToTeam1 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam1accordingToTeam2 = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTeam2accordingToTeam2 = null;

    #[ORM\OneToOne(targetEntity: Game::class)]
    private ?Game $parent = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bracket $bracket = null;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Game
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Game
    {
        $this->name = $name;
        return $this;
    }

    public function getIsFinished(): ?bool
    {
        return $this->isFinished;
    }


    public function setIsFinished(?bool $isFinished): Game
    {
        $this->isFinished = $isFinished;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    /**
     * @param Team|null $team1
     * @return Game
     */
    public function setTeam1(?Team $team1): Game
    {
        $this->team1 = $team1;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    /**
     * @param Team|null $team2
     * @return Game
     */
    public function setTeam2(?Team $team2): Game
    {
        $this->team2 = $team2;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam1(): ?int
    {
        return $this->scoreTeam1;
    }

    /**
     * @param int|null $scoreTeam1
     * @return Game
     */
    public function setScoreTeam1(?int $scoreTeam1): Game
    {
        $this->scoreTeam1 = $scoreTeam1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam2(): ?int
    {
        return $this->scoreTeam2;
    }

    /**
     * @param int|null $scoreTeam2
     * @return Game
     */
    public function setScoreTeam2(?int $scoreTeam2): Game
    {
        $this->scoreTeam2 = $scoreTeam2;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam1accordingToTeam1(): ?int
    {
        return $this->scoreTeam1accordingToTeam1;
    }

    /**
     * @param int|null $scoreTeam1accordingToTeam1
     * @return Game
     */
    public function setScoreTeam1accordingToTeam1(?int $scoreTeam1accordingToTeam1): Game
    {
        $this->scoreTeam1accordingToTeam1 = $scoreTeam1accordingToTeam1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam2accordingToTeam1(): ?int
    {
        return $this->scoreTeam2accordingToTeam1;
    }

    /**
     * @param int|null $scoreTeam2accordingToTeam1
     * @return Game
     */
    public function setScoreTeam2accordingToTeam1(?int $scoreTeam2accordingToTeam1): Game
    {
        $this->scoreTeam2accordingToTeam1 = $scoreTeam2accordingToTeam1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam1accordingToTeam2(): ?int
    {
        return $this->scoreTeam1accordingToTeam2;
    }

    /**
     * @param int|null $scoreTeam1accordingToTeam2
     * @return Game
     */
    public function setScoreTeam1accordingToTeam2(?int $scoreTeam1accordingToTeam2): Game
    {
        $this->scoreTeam1accordingToTeam2 = $scoreTeam1accordingToTeam2;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getScoreTeam2accordingToTeam2(): ?int
    {
        return $this->scoreTeam2accordingToTeam2;
    }

    /**
     * @param int|null $scoreTeam2accordingToTeam2
     * @return Game
     */
    public function setScoreTeam2accordingToTeam2(?int $scoreTeam2accordingToTeam2): Game
    {
        $this->scoreTeam2accordingToTeam2 = $scoreTeam2accordingToTeam2;
        return $this;
    }


    /**
     * @return Game|null
     */
    public function getParent(): ?Game
    {
        return $this->parent;
    }

    /**
     * @param Game|null $parent
     * @return Game
     */
    public function setParent(?Game $parent): Game
    {
        $this->parent = $parent;
        return $this;
    }

    public function getBracket(): ?Bracket
    {
        return $this->bracket;
    }

    public function setBracket(?Bracket $bracket): self
    {
        $this->bracket = $bracket;

        return $this;
    }

}
