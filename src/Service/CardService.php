<?php

namespace App\Service;

use App\Entity\Card;

class CardService
{
    public function __construct() {
    }

    public function save(Card $card): void
    {
        $this->gameRepository->save($card, true);
    }

    public function remove(Card $card): void
    {
        $this->gameRepository->remove($card, true);
    }
}
