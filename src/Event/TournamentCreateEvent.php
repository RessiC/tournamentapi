<?php

namespace App\Event;

use App\Entity\Tournament\Tournament;
use Symfony\Contracts\EventDispatcher\Event;

class TournamentCreateEvent extends Event
{
    public const NAME = 'tournament.create';
    private Tournament $tournament;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function getTournament(): Tournament
    {
        return $this->tournament;
    }

}