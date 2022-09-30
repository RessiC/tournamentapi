<?php

namespace App\Controller\User;

use App\Entity\User\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractFOSRestController
{

    #[Rest\Get('/api/players', name: 'get_players')]
    #[Rest\View]
    public function getPlayerUsers(UserService $userService)
    {
        return $userService->getAllPlayers();
    }

    #[Rest\Put('/api/players', name: 'post_player')]
    #[ParamConverter("PlayerUser", converter:"fos_rest.request_body")]
    public function putPlayerUser(UserService $userService, User $user)
    {
        return $userService->editPlayer($user);
    }

    // todo putPlayerById
}
