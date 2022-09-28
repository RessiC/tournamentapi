<?php

namespace App\Service;
use App\Repository\PlayerUserRepository;

class PlayerUserService
{
    private PlayerUserRepository $repository;

    /**
     * @param PlayerUserRepository $repository
     */
    public function __construct(PlayerUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllPlayers(): array
    {
        return $this->repository->findAll();
    }
}