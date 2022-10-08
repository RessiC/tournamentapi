<?php

namespace App\Tests\Entity\Tournament;

use App\Entity\Tournament\Tournament;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TournamentTest extends KernelTestCase
{
    public function testConstruct()
    {
        $tournament = new Tournament();

        $this->assertNotNull($tournament);
        $this->assertInstanceOf(Tournament::class, $tournament);
        $this->assertInstanceOf(DateTimeImmutable::class, $tournament->getCreatedAt());
        $this->assertInstanceOf(ArrayCollection::class, $tournament->getTeams());
    }
}