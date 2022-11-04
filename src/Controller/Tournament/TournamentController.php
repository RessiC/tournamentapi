<?php

namespace App\Controller\Tournament;

use App\Entity\Tournament\Game;
use App\Entity\Tournament\Tournament;
use App\Service\TournamentService;
use App\Service\TournamentCreateService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TournamentController extends AbstractFOSRestController
{
    /**
     * @param Tournament $tournament
     * @param TournamentCreateService $tournamentCreateService
     * @return Tournament
     */
    #[Rest\Post('/api/tournaments', name: 'post_tournament')]
    #[ParamConverter("tournament", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function postTournament(Tournament $tournament, TournamentCreateService $tournamentCreateService)
    {
        return $tournamentCreateService->createsTournament($tournament);
    }

    /**
     * @param TournamentService $tournamentService
     * @return array
     */
    #[Rest\Get('/api/tournaments', name: 'get_tournaments')]
    #[Rest\View]
    public function getTournaments(TournamentService $tournamentService)
    {
        return $tournamentService->getAllTournament();
    }

    /**
     * @param Tournament $tournament
     * @return Tournament
     */
    #[Rest\Get('/api/tournaments/{id}', name: 'get_tournament')]
    #[Rest\View]
    public function getTournamentById(Tournament $tournament): Tournament
    {
        return $tournament;
    }

    /**
     * @param Tournament $existingTournament
     * @param Tournament $tournament
     * @param TournamentService $tournamentService
     * @return Tournament
     */
    #[Rest\Put('/api/tournaments/{id}', name: 'put_tournament')]
    #[ParamConverter("tournament", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function putTournament(
        Tournament $existingTournament, Tournament $tournament, TournamentService $tournamentService): Tournament
    {
        return $tournamentService->editTournament($existingTournament, $tournament);
    }

    /**
     * @param Tournament $tournament
     * @param TournamentService $tournamentService
     */
    #[Rest\Delete('/api/tournaments/{id}', name: 'delete_tournament')]
    #[Rest\View]
    public function deleteTournament(Tournament $tournament, TournamentService $tournamentService)
    {
        $tournamentService->deleteTournament($tournament);
    }

    /**
     * @param Tournament $tournament
     * @param Game $game
     * @param TournamentService $tournamentService
     * @return Game
     */
    #[Rest\Post('/api/tournaments/{id}/games', name: 'post_tournament_game')]
    #[ParamConverter("game", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function postTournamentGame(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        return $tournamentService->postTournamentGame($tournament, $game);
    }

    /**
     * @param Tournament $tournament
     * @param TournamentService $tournamentService
     * @return array
     */
    #[Rest\Get('/api/tournaments/{id}/games', name: 'get_tournament_games')]
    #[Rest\View]
    public function getTournamentGames(Tournament $tournament, TournamentService $tournamentService): array
    {
        return $tournamentService->getTournamentGames($tournament);
    }

    /**
     * @param Tournament $tournament
     * @param Game $game
     * @param TournamentService $tournamentService
     * @return Game
     */
    #[Rest\Get('/api/tournaments/{id}/games/{game}', name: 'get_tournament_game')]
    #[Rest\View]
    public function getTournamentGameById(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        return $game;
    }

    /**
     * @param Tournament $tournament
     * @param Game $game
     * @param Game $modifiedGame
     * @param TournamentService $tournamentService
     * @return Game
     */
    #[Rest\Put('/api/tournaments/{id}/games/{game}', name: 'put_tournament_game')]
    #[ParamConverter("modifiedGame", class: "App\Entity\Tournament\Game", converter: "fos_rest.request_body")]
    #[Rest\View]
    public function putTournamentGame(Tournament $tournament, Game $game, Game $modifiedGame, TournamentService $tournamentService): Game
    {
        return $tournamentService->editTournamentGame($tournament, $game, $modifiedGame);
    }

    /**
     * @param Tournament $tournament
     * @param Game $game
     * @param TournamentService $tournamentService
     */
    #[Rest\Delete('/api/tournaments/{id}/games/{game}', name: 'delete_tournament_game')]
    #[Rest\View]
    public function deleteTournamentGameById(Tournament $tournament, Game $game, TournamentService $tournamentService)
    {
        $tournamentService->deleteGame($game);
    }
}