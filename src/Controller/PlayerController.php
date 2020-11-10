<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class PlayerController extends BaseController
{
    public function info()
    {
        $player = $this->getUser();
        return new JsonResponse([
            'username' => $player->getUsername(),
            'token' => $player->getToken(),
            'role' => $player->getRoles()
        ]);
    }

    public function register()
    {
        return new JsonResponse(['playerController::register']);
    }
}