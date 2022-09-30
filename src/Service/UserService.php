<?php

namespace App\Service;
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

    public function getAllPlayers(): array
    {
        return $this->userRepository->findAll();
    }



}