<?php

namespace App\Controller\User;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\PlayerUserService;

class PlayerUserController extends AbstractFOSRestController
{
    #[Rest\Get('/api/players', name: 'get_players')]
    #[Rest\View]
    public function getPlayerUsers(PlayerUserService $playerUserService)
    {
        return $playerUserService->getAllPlayers();
    }
}
