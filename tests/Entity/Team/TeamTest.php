<?php

namespace App\Tests\Entity\Team;

use App\Entity\Team\Team;
use App\Entity\Tournament\Tournament;
use App\Entity\User\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TeamTest extends KernelTestCase
{
    public function testConstruct()
    {
        $team = new Team();

        $this->assertNotNull($team);
        $this->assertInstanceOf(Team::class, $team);
    }

    public function testAddPlayers()
    {
        $team = new Team();
        $player1 = new User();
        $player2= new User();
        $team->addPlayer($player1);
        $team->addPlayer($player2);

        $this->assertNotNull($team->getPlayers());
        $this->assertInstanceOf(Team::class, $team);
        $this->assertContainsOnlyInstancesOf(User::class, $team->getPlayers());
    }

    public function testRemovePlayer()
    {
        $team = new Team();
        $player1 = new User();
        $team->addPlayer($player1);
        $team->removePlayer($player1);

        $this->assertCount(0, $team->getPlayers());
    }

    public function testJoinTournament()
    {
        $tournament = new Tournament();
        $team = new Team();
        $team->addTournament($tournament);

        $this->assertNotNull($team->getTournaments());
        $this->assertContainsOnlyInstancesOf(Tournament::class, $team->getTournaments());
    }

    public function testLeaveTournament()
    {
        $tournament = new Tournament();
        $team = new Team();
        $team->addTournament($tournament);

        $this->assertNull($team->getTournaments());
    }
}