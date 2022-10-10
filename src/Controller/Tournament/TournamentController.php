<?php

namespace App\Controller\Tournament;

use App\Entity\Tournament\Tournament;
use App\Service\TournamentService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TournamentController extends AbstractFOSRestController
{
    #[Rest\Post('/api/tournaments', name: 'post_tournament')]
    #[ParamConverter("tournament", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function postTournament(Tournament $tournament, TournamentService $tournamentService)
    {
        return $tournamentService->postTournament($tournament);
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
    #[ParamConverter("tournament", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function putTournament(Tournament $existingTournament, Tournament $tournament, TournamentService $tournamentService): Tournament
    {
        return $tournamentService->editTournament($existingTournament, $tournament);
    }

    #[Rest\Delete('/api/tournaments/{id}', name: 'delete_tournament')]
    #[Rest\View]
    public function deleteTournament(Tournament $tournament, TournamentService $tournamentService)
    {
        $tournamentService->deleteTournament($tournament);
    }

    #[Rest\Get('/api/tournaments/{id}/games', name: 'get_tournament_games')]
    #[Rest\View]
    public function getTournamentGames(Tournament $tournament, TournamentService $tournamentService)
    {
        return $tournamentService->getTournamentGames($tournament->getId());
    }


}