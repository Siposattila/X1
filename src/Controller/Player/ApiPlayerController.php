<?php

namespace App\Controller\Player;

use App\Constant\PlayerConstant;
use App\Entity\Player;
use App\ParamResolver\Param;
use App\Service\PlayerService;
use App\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/player", name: "app_api_player_")]
class ApiPlayerController extends AbstractApiController
{
    public function __construct(
        private readonly PlayerService $playerService
    ) {
    }

    #[Route("", name: "create", methods: ["POST"])]
    public function create(#[Param(validate: true)] Player $player): JsonResponse
    {
        $player->setGameId(null);
        $player->setChips(PlayerConstant::PLAYER_STARTING_CHIPS);
        $this->playerService->save($player, true);

        return $this->handleSuccess([
            "name" => $player->getName(),
            "email" => $player->getEmail()
        ], true);
    }

    #[Route("/login", name: "login", methods: ["POST"])]
    public function login(#[Param] Player $player): JsonResponse
    {
        $player = $this->playerService->getPlayerByName($player->getName());

        return $this->handleSuccess([
            "name" => $player->getName(),
            "email" => $player->getEmail()
        ], true);
    }
}
