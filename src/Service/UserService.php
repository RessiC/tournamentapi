<?php

namespace App\Service;
use App\Entity\User\User;
use App\Entity\Team\Team;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Exception\ValidatorException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserService
{
    private ManagerRegistry $managerRegistry;
    private UserRepository $userRepository;
    private ValidatorInterface $validator;

    public function __construct( ManagerRegistry $managerRegistry, UserRepository $userRepository, ValidatorInterface $validator)
    {
        $this->managerRegistry = $managerRegistry;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function editUser(User $existingUser, User $modifiedUser): User
    {
        $errors = $this->validator->validate($modifiedUser);
        if (count($errors) > 0)
        {
            throw new ValidatorException($errors);
        } else {
            $existingUser->setEmail($modifiedUser->getEmail());
            $existingUser->setRoles($modifiedUser->getRoles());
            $existingUser->setIsConfirmed($modifiedUser->isConfirmed());
            $existingUser->setIsPlayer($modifiedUser->isPlayer());
            //$existingUser->setPassword($modifiedUser->getPassword());
            $existingUser->setGamerTag($modifiedUser->getGamerTag());
            $existingUser->setIsCaptain($modifiedUser->isCaptain());
            $existingUser->setPoints($modifiedUser->getPoints());

            $this->managerRegistry->getManager()->persist($existingUser);
            $this->managerRegistry->getManager()->flush();

            return $existingUser;
        }
    }

    public function deleteUser(User $user): void
    {
        $this->managerRegistry->getManager()->remove($user);
        $this->managerRegistry->getManager()->flush();
    }

    public function createUser(User $user): User
    {
        $errors = $this->validator->validate($user);
        if (count($errors) > 0)
        {
            throw new ValidatorException($errors);
        } else {
            $this->managerRegistry->getManager()->persist($user);
            $this->managerRegistry->getManager()->flush();
            return $user;
        }
    }

    public function playerJoinTeam(User $player,  Team $team): void
    {
        $player->setTeam($team);
        $this->managerRegistry->getManager()->persist($player);
        $this->managerRegistry->getManager()->flush();
    }

    public function playerLeaveTeam(User $player, Team $team)
    {
        $team->removePlayer($player);
        $this->managerRegistry->getManager()->persist($player);
        $this->managerRegistry->getManager()->flush();
    }
}