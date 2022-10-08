<?php

namespace App\Controller\Team;

use App\Entity\Team\Team;
use App\Entity\Tournament\Tournament;
use App\Service\TeamService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TeamController extends AbstractFOSRestController
{

    #[Rest\Post('/api/teams', name: 'post_team')]
    #[ParamConverter("team", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function postTeam(Team $team, TeamService $teamService)
    {
        return $teamService->createTeam($team);
    }

    #[Rest\Get('/api/teams', name: 'get_teams')]
    #[Rest\View]
    public function getTeams(TeamService $teamService)
    {
        return $teamService->getAllTeams();
    }

    #[Rest\Get('/api/teams/{id}', name: 'get_team')]
    #[Rest\View]
    public function getTeamById(Team $team)
    {
        return $team;
    }

    #[Rest\Put('/api/teams/{id}', name: 'put_team')]
    #[ParamConverter("team", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function putTeam(Team $existingTeam, Team $team, TeamService $teamService)
    {
        return $teamService->editTeam($existingTeam, $team);
    }

    #[Rest\Delete('/api/teams/{id}', name: 'delete_team')]
    #[Rest\View]
    public function deleteTeam(Team $team, TeamService $teamService)
    {
        $teamService->deleteTeam($team);
    }

    #[Rest\Put('api/teams/{id}/tournaments/{tournament}', name: 'team_join_tournament')]
    #[Rest\View]
    public function teamJoinTournament(Team $team, Tournament $tournament, TeamService $teamService)
    {
        $teamService->teamJoinTournament($team, $tournament);
        return $team;
    }

    #[Rest\Delete('api/teams/{id}/tournaments/{tournament}', name: 'team_leave_tournament')]
    #[Rest\View]
    public function teamLeaveTournament(Team $team, Tournament $tournament, TeamService $teamService)
    {
        $teamService->teamLeaveTournament($team, $tournament);
        return $team;
    }
}