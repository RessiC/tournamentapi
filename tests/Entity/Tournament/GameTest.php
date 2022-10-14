<?php

namespace App\Tests\Entity\Tournament;

use App\Entity\Team\Team;
use App\Entity\Tournament\Game;
use App\Entity\Tournament\Tournament;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GameTest extends KernelTestCase
{
    public function testConstruct(): void
    {
        $game = new Game();

        $this->assertNotNull($game);
        $this->assertInstanceOf(Game::class, $game);
    }

    public function testAddTeam(): void
    {
        $game = new Game();
        $team1 = new Team();
        $team2 = new Team();
        $game->addTeam($team1);
        $game->addTeam($team2);

        $this->assertNotNull($game->getTeams());
        $this->assertInstanceOf(Game::class, $game);
        $this->assertContainsOnlyInstancesOf(Team::class, $game->getTeams());
    }

    public function testRemoveTeam(): void
    {
        $game = new Game();
        $team = new Team();
        $game->addTeam($team);
        $game->removeTeam($team);

        $this->assertCount(0, $game->getTeams());
    }

    public function testGetTournament(): void
    {
        $game = new Game();
        $tournament = new Tournament();
        $game->setTournament($tournament);

        $this->assertNotNull($game->getTournament());
        $this->assertInstanceOf(Tournament::class, $game->getTournament());
    }
}