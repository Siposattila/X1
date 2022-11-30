<?php

namespace App\Messenger;

use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;

class TestPublish extends AbstractPublish
{
    public function __construct(MessageBusInterface $messageBusInterface)
    {
        parent::__construct($messageBusInterface, "testPublish", [
            "test" => rand(PHP_INT_MIN, PHP_INT_MAX)
        ]);
    }
}
