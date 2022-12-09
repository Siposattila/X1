<?php

namespace App\Controller\Game;

use App\Entity\Game;
use App\Entity\Player;
use App\ParamResolver\Param;
use App\Service\GameService;
use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/game", name: "app_api_game_")]
class ApiGameController extends AbstractApiController
{
    public function __construct(
        private readonly GameService $gameService
    ) {
    }

    #[Route("", name: "create", methods: ["POST"])]
    public function create(): JsonResponse
    {
        $this->gameService->createGame();

        return $this->handleSuccess([], true);
    }

    #[Route("/{gameId}/{id}", name: "join", methods: ["GET"])]
    public function join(#[Param(attribute: "gameId", attributeType: "string")] Game $game, #[Param] Player $player): JsonResponse
    {
        return $this->handleSuccess(
            ["gameId" => $this->gameService->joinGame($game, $player)]
        );
    }

    #[Route("/{id}", name: "quit", methods: ["GET"])]
    public function quit(#[Param] Player $player): JsonResponse
    {
        $this->gameService->quitGame($player);

        return $this->handleSuccess();
    }
}
