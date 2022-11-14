<?php

namespace App\Service;

use App\Entity\Tournament\Tournament;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TournamentCreateService {

    private ManagerRegistry $managerRegistry;
    private ValidatorInterface $validator;

    public function __construct(
        ManagerRegistry $managerRegistry,
        ValidatorInterface $validator
    ) {
        $this->managerRegistry = $managerRegistry;
        $this->validator = $validator;
    }

    /**
     * @param Tournament $tournament
     * @return Tournament
     */
    public function createsTournament(Tournament $tournament): Tournament
    {
        $errors = $this->validator->validate($tournament);
        if (count($errors) > 0) {
            throw new ValidatorException($errors);
        } else {
            $tournament->initialize();
            //$this->managerRegistry->getManager()->persist($tournament);
            //$this->managerRegistry->getManager()->flush();
        }

        return $tournament;
    }
}