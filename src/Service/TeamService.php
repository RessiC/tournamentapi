<?php

namespace App\Service;

use App\Entity\Team\Team;
use App\Repository\TeamRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TeamService
{
    private ManagerRegistry $managerRegistry;
    private TeamRepository $teamRepository;
    private ValidatorInterface $validator;

    public function __construct( ManagerRegistry $managerRegistry, TeamRepository $teamRepository, ValidatorInterface $validator)
    {
        $this->managerRegistry = $managerRegistry;
        $this->teamRepository = $teamRepository;
        $this->validator = $validator;
    }

    public function getAllTeams(): array
    {
        return $this->teamRepository->findAll();
    }

    public function editTeam(Team $existingTeam, Team $modifiedTeam): Team
    {
        $errors = $this->validator->validate($modifiedTeam);
        if (count($errors) > 0)
        {
            throw new ValidatorException($errors);
        } else {
            $existingTeam->setName($modifiedTeam->getName());
            return $existingTeam;
        }
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

    public function createTeam(Team $team)
    {
        $errors = $this->validator->validate($team);
        if (count($errors) > 0)
        {
            throw new ValidatorException($errors);
        } else {
            $this->managerRegistry->getManager()->persist($team);
            $this->managerRegistry->getManager()->flush();

            return $team;
        }
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