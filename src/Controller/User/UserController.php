<?php

namespace App\Controller\User;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations\View;

class UserController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/test")
     * @View()
     */
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/User/UserController.php',
        ]);
    }
}
