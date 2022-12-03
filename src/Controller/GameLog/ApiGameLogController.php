<?php

namespace App\Controller\GameLog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiGameLogController extends AbstractController
{
    #[Route('/api/game/log', name: 'app_api_game_log')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiGameLogController.php',
        ]);
    }
}
