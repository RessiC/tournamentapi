<?php

namespace App\EventSubscriber;

use App\Entity\Tournament\Tournament;
use App\EventSubscriber\TournamentCreateEvent;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TournamentEventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            TournamentCreateEvent::NAME => 'onTournamentCreation',
            TournamentUpdateEvent::NAME => 'onTournamentUpdating',

        ];
    }

    public function onTournamentCreation(TournamentCreateEvent $event)
    {
    }

    public function onTournamentUpdating(TournamentUpdateEvent $event)
    {

    }


}