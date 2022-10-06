<?php

namespace App\Tests\Entity;

use App\Entity\Team\Team;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TeamTest extends KernelTestCase
{
    public function testConstruct()
    {
        $team = new Team();

        $this->assertNotNull($team);
        $this->assertInstanceOf(Team::class, $team);
        $this->assertNotNull($team->getPlayers());

    }
}