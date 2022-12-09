<?php

namespace App\Messenger;

use Symfony\Component\Messenger\MessageBusInterface;

class GamePublish extends AbstractPublish
{
    public function __construct(MessageBusInterface $messageBusInterface, string $gameId, ?string $action = null, ?string $message = null)
    {
        parent::__construct($messageBusInterface, $gameId."Game", [
            "action" => $action,
            "message" => $message
        ]);
    }
}
