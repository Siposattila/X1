<?php

namespace App\Controller\Card;

use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiCardController extends AbstractApiController
{
    // TODO: implement
    #[Route('/api/card', name: 'app_api_card')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ApiCardController.php',
        ]);
    }
}
