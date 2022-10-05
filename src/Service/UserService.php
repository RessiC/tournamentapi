<?php

namespace App\Service;
use App\Entity\User\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserService
{
    private ManagerRegistry $managerRegistry;
    private UserRepository $userRepository;

    public function __construct( ManagerRegistry $managerRegistry, UserRepository $userRepository)
    {
        $this->managerRegistry = $managerRegistry;
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        return $this->userRepository->findAll();
    }

    public function editUser(User $existingUser, User $modifiedUser): User
    {
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

    public function deleteUser(User $user): void
    {
        $this->managerRegistry->getManager()->remove($user);
        $this->managerRegistry->getManager()->flush();
    }

    public function createUser(User $user): User
    {
        $this->managerRegistry->getManager()->persist($user);
        $this->managerRegistry->getManager()->flush();

        return $user;
    }
}