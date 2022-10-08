<?php

namespace App\Controller\User;

use App\Entity\Team\Team;
use App\Entity\User\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Service\UserService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class UserController extends AbstractFOSRestController
{
    #[Rest\Post('/api/players', name: 'post_player')]
    #[ParamConverter("user", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function postUser(User $user, UserService $userService)
    {
        return $userService->createUser($user);
    }

    #[Rest\Get('/api/players', name: 'get_players')]
    #[Rest\View]
    public function getUsers(UserService $userService)
    {
        return $userService->getAllUsers();
    }

    #[Rest\Get('/api/players/{id}', name: 'get_player')]
    #[Rest\View]
    public function getUserById(User $user)
    {
        return $user;
    }

    #[Rest\Put('/api/players/{id}', name: 'put_player')]
    #[ParamConverter("user", converter:"fos_rest.request_body")]
    #[Rest\View]
    public function putUser(User $existingUser, User $user, UserService $userService)
    {
        return $userService->editUser($existingUser, $user);
    }

    #[Rest\Delete('/api/players/{id}', name: 'delete_player')]
    #[Rest\View]
    public function deleteUser(User $user, UserService $userService)
    {
        $userService->deleteUser($user);
    }

    #[Rest\Put('/api/players/{id}/teams/{team}', name: 'player_join_team')]
    #[Rest\View]
    public function playerJoinTeam(User $player, Team $team, UserService $userService)
    {
        $userService->playerJoinTeam($player, $team);
        return $player;
    }

    #[Rest\Delete('/api/players/{id}/teams/{team}', name: 'player_leave_team')]
    #[Rest\View]
    public function playerLeaveTeam(User $player, Team $team, UserService $userService)
    {
        $userService->playerLeaveTeam($player, $team);
        return $player;
    }
}
