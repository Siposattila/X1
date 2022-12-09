<?php

namespace App\Messenger;

use App\Entity\Card;
use Symfony\Component\Messenger\MessageBusInterface;

class CardPublish extends AbstractPublish
{
    // TODO: rethink
    public function __construct(MessageBusInterface $messageBusInterface, string $gameId, Card $card)
    {
        parent::__construct($messageBusInterface, $gameId."Card", [
            "card" => $card
        ]);
    }
}
