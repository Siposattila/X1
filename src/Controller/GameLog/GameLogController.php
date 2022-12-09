<?php

namespace App\Controller\GameLog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameLogController extends AbstractController
{
    // TODO: implement
    #[Route('/game/log', name: 'app_game_log')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/GameLogController.php',
        ]);
    }
}
