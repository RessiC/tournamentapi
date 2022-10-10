<?php

namespace App\Service;

use App\Entity\Team\Team;
use App\Entity\Tournament\Tournament;
use App\Repository\GameRepository;
use App\Repository\TournamentRepository;
use Doctrine\Persistence\ManagerRegistry;

class TournamentService
{
    private ManagerRegistry $managerRegistry;
    private GameRepository $gameRepository;
    private TournamentRepository $tournamentRepository;

    public function __construct(ManagerRegistry $managerRegistry, GameRepository $gameRepository, TournamentRepository $tournamentRepository)
    {
        $this->managerRegistry = $managerRegistry;
        $this->gameRepository = $gameRepository;
        $this->tournamentRepository = $tournamentRepository;
    }

    public function postTournament(Tournament $tournament): Tournament
    {
        $tournament->setCreatedAt(new \DateTimeImmutable("now"));
        $this->managerRegistry->getManager()->persist($tournament);
        $this->managerRegistry->getManager()->flush();

        return $tournament;
    }

    public function getAllTournament(): array
    {
        return $this->tournamentRepository->findAll();
    }

    public function editTournament(Tournament $existingTournament, Tournament $modifiedTournament): Tournament
    {
        $existingTournament->setName($modifiedTournament->getName());
        $existingTournament->setCashPrice($modifiedTournament->getCashPrice());
        $existingTournament->setLinkTwitch($modifiedTournament->getLinkTwitch());
        $existingTournament->setStartAt($modifiedTournament->getStartAt());
        $existingTournament->setPoints($modifiedTournament->getPoints());
        $existingTournament->setType($modifiedTournament->getType());
        $this->managerRegistry->getManager()->persist($existingTournament);
        $this->managerRegistry->getManager()->flush();

        return $existingTournament;
    }

    public function deleteTournament(Tournament $tournament)
    {
        $this->managerRegistry->getManager()->remove($tournament);
        $this->managerRegistry->getManager()->flush();
    }

    public function getTournamentGames(int $id)
    {
        return $this->gameRepository->findGamesByTournament($id);
    }

}