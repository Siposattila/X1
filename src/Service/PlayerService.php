<?php

namespace App\Service;

use App\Entity\Player;
use App\Repository\PlayerRepository;

class PlayerService
{
    public function __construct(
        private readonly PlayerRepository $playerRepository
    ) {
    }

    public function save(Player $player): void
    {
        $this->playerRepository->save($player, true);
    }

    public function remove(Player $player): void
    {
        $this->playerRepository->remove($player, true);
    }

    public function getPlayerByName(string $name): Player
    {
        return $this->playerRepository->findOneBy(["name" => $name]);
    }
}
