<?php

namespace App\Service;

use App\Entity\Tournament\Tournament;
use App\Entity\Tournament\Game;
use App\Repository\GameRepository;
use App\Repository\TournamentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TournamentService
{
    private ManagerRegistry $managerRegistry;
    private GameRepository $gameRepository;
    private TournamentRepository $tournamentRepository;
    private ValidatorInterface $validator;

    public function __construct(
        ManagerRegistry $managerRegistry,
        GameRepository $gameRepository,
        TournamentRepository $tournamentRepository,
        ValidatorInterface $validator,
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->gameRepository = $gameRepository;
        $this->tournamentRepository = $tournamentRepository;
        $this->validator = $validator;
    }

    public function createsTournament(Tournament $tournament): Tournament
    {
        $errors = $this->validator->validate($tournament);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        } else {
            $tournament->setCreatedAt(new \DateTime());
            $this->generateGame($tournament);
            //$this->managerRegistry->getManager()->persist($tournament);
            //$this->managerRegistry->getManager()->flush();
        }

        return $tournament;
    }

    public function generateGame(Tournament $tournament)
    {
        $amountOfGameNeeded = $this->getAmountOfGameNeeded($tournament->getTeamsNeeded(), $tournament->hasBracketLooser());
        for ($i = 0; $i < $amountOfGameNeeded; $i++) {
            $game = new Game();
            $game->setName($i);
        }




        //next step: need to assign team in each first game depending on team rank when tournamentIsStarted


    }

    public function getAllTournament(): array
    {
        return $this->tournamentRepository->findAll();
    }

    public function editTournament(Tournament $existingTournament, Tournament $modifiedTournament): Tournament
    {
        $errors = $this->validator->validate($modifiedTournament);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        } else {
            $existingTournament->setName($modifiedTournament->getName());
            $existingTournament->setCashPrice($modifiedTournament->getCashPrice());
            $existingTournament->setLinkTwitch($modifiedTournament->getLinkTwitch());
            $existingTournament->setStartAt($modifiedTournament->getStartAt());
            $existingTournament->setPoints($modifiedTournament->getPoints());
            $this->managerRegistry->getManager()->persist($existingTournament);
            $this->managerRegistry->getManager()->flush();

            return $existingTournament;
        }
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

    public function postTournamentGame(Tournament $tournament, Game $game): Game
    {
        $errors = $this->validator->validate($game);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        } else {
            $game->setTournament($tournament);
            $game->setIsFinished(false);
            $this->managerRegistry->getManager()->persist($game);
            $this->managerRegistry->getManager()->flush();

            return $game;
        }
    }

    public function editTournamentGame(Tournament $tournament, Game $existingGame, Game $modifiedGame): Game
    {
        $errors = $this->validator->validate($modifiedGame);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        }

        $existingGame->setScoreTeam1($modifiedGame->getScoreTeam1());
        $existingGame->setScoreTeam2($modifiedGame->getScoreTeam2());
        $existingGame->setIsFinished($modifiedGame->isFinished());

        $this->managerRegistry->getManager()->persist($existingGame);
        $this->managerRegistry->getManager()->flush();

        return $existingGame;
    }

    public function deleteGame(Game $game)
    {
        $this->managerRegistry->getManager()->remove($game);
        $this->managerRegistry->getManager()->flush();
    }

    private function getAmountOfGameNeeded(int $amountOfTeams, bool $hasBracketLooser): int
    {
        $amount = 1;
        for ($i = 1; $i <= $amountOfTeams; $i += 2) {
            $amount = $i;
        }

        if ($hasBracketLooser) {
            $amount = $amount * 2;
        }

        return $amount;
    }


}