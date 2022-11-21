<?php

namespace App\Service;

use App\Entity\Tournament\Bracket;
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

    public function getAllTournament(): array
    {
        return $this->tournamentRepository->findAll();
    }

    /**
     * @param Tournament $existingTournament
     * @param Tournament $modifiedTournament
     * @return Tournament
     */
    public function editTournament(Tournament $existingTournament, Tournament $modifiedTournament): Tournament
    {
        $errors = $this->validator->validate($modifiedTournament);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);

        } else {
            $existingTournament->copyFrom($modifiedTournament);

            $this->managerRegistry->getManager()->persist($existingTournament);
            $this->managerRegistry->getManager()->flush();

            return $existingTournament;
        }
    }

    public function editTournamentGame(Tournament $tournament, Game $existingGame, Game $modifiedGame): Game
    {
        $errors = $this->validator->validate($modifiedGame);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        }

        $existingGame->copyFrom($modifiedGame);
        $tournament->checkEndMatch($existingGame);

        $this->managerRegistry->getManager()->persist($existingGame);
        $this->managerRegistry->getManager()->flush();

        return $existingGame;
    }

    public function deleteTournament(Tournament $tournament)
    {
        $this->managerRegistry->getManager()->remove($tournament);
        $this->managerRegistry->getManager()->flush();
    }

    public function getTournamentGames(Tournament $tournament): array
    {
        $games = [];
        /** @var Bracket $bracket */
        foreach ($tournament->getBrackets() as $bracket) {
            $games[] = $this->gameRepository->findBy(["bracket" => $bracket->getId()]);
        }
        return $games;
    }

    public function postTournamentGame(Tournament $tournament, Game $game): Game
    {
        $errors = $this->validator->validate($game);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        } else {
            $game->setIsFinished(false);
            $this->managerRegistry->getManager()->persist($game);
            $this->managerRegistry->getManager()->flush();

            return $game;
        }
    }



    public function deleteGame(Game $game)
    {
        $this->managerRegistry->getManager()->remove($game);
        $this->managerRegistry->getManager()->flush();
    }

}