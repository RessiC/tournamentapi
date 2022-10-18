<?php

namespace App\EventSubscriber;

use Symfony\Contracts\EventDispatcher\Event;

class TournamentUpdateEvent extends Event
{
    public const NAME = 'tournament.update';

}