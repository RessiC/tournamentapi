<?php

namespace App\Service;

use App\Entity\Team\Team;
use App\Repository\TeamRepository;
use Doctrine\Persistence\ManagerRegistry;

class TeamService
{
    private ManagerRegistry $managerRegistry;
    private TeamRepository $teamRepository;

    public function __construct( ManagerRegistry $managerRegistry, TeamRepository $teamRepository)
    {
        $this->managerRegistry = $managerRegistry;
        $this->teamRepository = $teamRepository;
    }

    public function getAllTeams(): array
    {
        return $this->teamRepository->findAll();
    }

    public function editTeam(Team $existingTeam, Team $modifiedTeam): Team
    {
        $existingTeam->setName($modifiedTeam->getName());
        return $existingTeam;
    }

    public function deleteTeam(Team $team): void
    {
        $players = $team->getPlayers();
        foreach ($players as $player)
        {
            $team->removePlayer($player);
        }
        $this->managerRegistry->getManager()->remove($team);
        $this->managerRegistry->getManager()->flush();
    }

    public function createTeam(Team $team): Team
    {
        $this->managerRegistry->getManager()->persist($team);
        $this->managerRegistry->getManager()->flush();

        return $team;
    }

    public function teamJoinTournament(Team $team, \App\Entity\Tournament\Tournament $tournament)
    {
        $tournament->addTeam($team);
        $this->managerRegistry->getManager()->persist($tournament);
        $this->managerRegistry->getManager()->flush();
    }

    public function teamLeaveTournament(Team $team, \App\Entity\Tournament\Tournament $tournament)
    {
        $tournament->removeTeam($team);
        $this->managerRegistry->getManager()->persist($tournament);
        $this->managerRegistry->getManager()->flush();
    }
}