<?php

namespace App\EventSubscriber;

use App\Event\GameUpdateEvent;
use App\Event\TournamentCreateEvent;
use App\Event\TournamentUpdateEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TournamentEventSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            TournamentCreateEvent::NAME => 'onTournamentCreation',
            TournamentUpdateEvent::NAME => 'onTournamentUpdating',
            GameUpdateEvent::NAME =>  'onGameUpdating',

        ];
    }

    /**
     * @throws \Exception
     */
    public function onGameUpdating(GameUpdateEvent $event)
    {
        $event->setNextGame();
        $event->stopPropagation();
    }

}