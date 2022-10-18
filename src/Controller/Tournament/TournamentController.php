<?php

namespace App\Controller\Tournament;

use App\Entity\Tournament\Game;
use App\Entity\Tournament\Tournament;
use App\EventSubscriber\TournamentCreateEvent;
use App\EventSubscriber\TournamentEventSubscriber;
use App\Service\TournamentService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TournamentController extends AbstractFOSRestController
{
    private EventDispatcherInterface $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    #[Rest\Post('/api/tournaments', name: 'post_tournament')]
    #[ParamConverter("tournament", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function postTournament(Tournament $tournament, TournamentService $tournamentService)
    {
        return $tournamentService->postTournament($tournament);

        /*
        $event = new TournamentCreateEvent($tournament);
        $this->eventDispatcher->addSubscriber(new TournamentEventSubscriber());
        $this->eventDispatcher->dispatch($event, TournamentCreateEvent::NAME); */
    }

    #[Rest\Get('/api/tournaments', name: 'get_tournaments')]
    #[Rest\View]
    public function getTournaments(TournamentService $tournamentService)
    {
        return $tournamentService->getAllTournament();
    }

    #[Rest\Get('/api/tournaments/{id}', name: 'get_tournament')]
    #[Rest\View]
    public function getTournamentById(Tournament $tournament)
    {
        return $tournament;
    }

    #[Rest\Put('/api/tournaments/{id}', name: 'put_tournament')]
    #[ParamConverter("tournament", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function putTournament(
        Tournament $existingTournament,
        Tournament $tournament,
        TournamentService $tournamentService
    ): Tournament {
        return $tournamentService->editTournament($existingTournament, $tournament);
    }

    #[Rest\Delete('/api/tournaments/{id}', name: 'delete_tournament')]
    #[Rest\View]
    public function deleteTournament(Tournament $tournament, TournamentService $tournamentService)
    {
        $tournamentService->deleteTournament($tournament);
    }

    #[Rest\Post('/api/tournaments/{id}/games', name: 'post_tournament_game')]
    #[ParamConverter("game", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function postTournamentGame(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        return $tournamentService->postTournamentGame($tournament, $game);
    }

    #[Rest\Get('/api/tournaments/{id}/games', name: 'get_tournament_games')]
    #[Rest\View]
    public function getTournamentGames(Tournament $tournament, TournamentService $tournamentService)
    {
        return $tournamentService->getTournamentGames($tournament->getId());
    }

    #[Rest\Get('/api/tournaments/{id}/games/{game}', name: 'get_tournament_game')]
    #[Rest\View]
    public function getTournamentGameById(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        return $game;
    }

    #[Rest\Put('/api/tournaments/{id}/games/{game}', name: 'put_tournament_game')]
    #[ParamConverter("modifiedGame", class: "App\Entity\Tournament\Game", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function putTournamentGame(Tournament $tournament, Game $game, Game $modifiedGame, TournamentService $tournamentService): Game
    {
        return $tournamentService->editTournamentGame($tournament, $game, $modifiedGame);
    }

    #[Rest\Delete('/api/tournaments/{id}/games/{game}', name: 'delete_tournament_game')]
    #[Rest\View]
    public function deleteTournamentGameById(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        $tournamentService->deleteGame($game);
    }


}