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

    #[ORM\ManyToOne(cascade: ["persist"], inversedBy: 'games')]
    private ?Tournament $tournament = null;

    private static array $listGameName = [
        0 => 1,
        1 => 2,
    ];


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
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): self
    {
        $this->isFinished = $isFinished;

        return $this;
    }

    public function getScoreTeam1(): ?int
    {
        return $this->scoreTeam1;
    }

    public function setScoreTeam1(?int $scoreTeam1): self
    {
        $this->scoreTeam1 = $scoreTeam1;

        return $this;
    }

    public function getScoreTeam2(): ?int
    {
        return $this->scoreTeam2;
    }

    public function setScoreTeam2(?int $scoreTeam2): self
    {
        $this->scoreTeam2 = $scoreTeam2;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): self
    {
        $this->tournament = $tournament;

        return $this;
    }

    public static function getListNameGame(): array
    {
        return self::$listGameName;
    }

    public function getTeam1(): ?Team
    {
        return $this->team1;
    }

    public function setTeam1(?Team $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?Team
    {
        return $this->team2;
    }

    public function setTeam2(?Team $team2): self
    {
        $this->team2 = $team2;

        return $this;
    }
}
