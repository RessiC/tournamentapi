<?php

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;

class TournamentUpdateEvent extends Event
{
    public const NAME = 'tournament.update';

}