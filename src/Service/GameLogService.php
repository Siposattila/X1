<?php

namespace App\Service;

use App\Entity\GameLog;
use App\Repository\GameLogRepository;

class GameLogService
{
    public function __construct(
        private readonly GameLogRepository $gameLogRepository
    ) {
    }

    public function save(GameLog $gameLog): void
    {
        $this->gameLogRepository->save($gameLog, true);
    }

    public function remove(GameLog $gameLog): void
    {
        $this->gameLogRepository->remove($gameLog, true);
    }
}
