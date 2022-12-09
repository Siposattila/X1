<?php

namespace App\Service;

use App\Constant\GameConstant;
use App\Entity\Game;
use App\Entity\Player;
use App\Exception\GameNotFoundException;
use App\Exception\GameNotJoinableException;
use App\Helper\UniqueIdHelper;
use App\Messenger\GamePublish;
use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class GameService
{
    public function __construct(
        private readonly MessageBusInterface $messageBusInterface,
        private readonly GameRepository $gameRepository,
        private readonly PlayerRepository $playerRepository
    ) {
    }

    public function save(Game $game): void
    {
        $this->gameRepository->save($game, true);
    }

    public function remove(Game $game): void
    {
        $this->gameRepository->remove($game, true);
    }

    public function createGameWithMaster(Player $player): void
    {
        $this->createGameWithMaster($player);
    }

    public function createGame(Player $player = null): void
    {
        $newGame = new Game();
        $newGame->setGameId(UniqueIdHelper::uniqueId());
        $newGame->setStatus(GameConstant::GAME_STARTING);

        if (!empty($player)) {
            $newGame->setMasterId($player->getId());
        }

        $this->gameRepository->save($newGame, true);
        new GamePublish($this->messageBusInterface, $newGame->getGameId());
    }

    public function joinGame(Game $game, Player $player): string
    {
        if (!empty($player->getGame())) {
            return $player->getGame()->getGameId();
        }

        if ($game->getId() == null) {
            throw new GameNotFoundException("Can't find the game with the given game id!");
        }

        if ($game->getStatus() == GameConstant::GAME_ACTIVE) {
            throw new GameNotJoinableException("The game is already started!");
        }

        $player->setGameId($game->getId());
        $this->playerRepository->save($player, true);
        
        return $game->getGameId();
    }

    public function quitGame(Player $player): void
    {
        // TODO: if he quits all in? :D
        // no no if he quits then we should throw his hand in
        $player->setGame(null);
        $this->playerRepository->save($player, true);
    }

    public function throwHand(): void
    {
        // TODO: implement
    }

    public function pass(): void
    {
        // TODO: implement
    }

    public function raise(): void
    {
        // TODO: implement
    }

    public function allIn(): void
    {
        // TODO: implement
    }
}
