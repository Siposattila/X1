<?php

namespace App\Messenger;

use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;

class AbstractPublish
{
    public function __construct(MessageBusInterface $messageBusInterface, string $topic, array $data = [])
    {
        $messageBusInterface->dispatch(
            new Update($topic, json_encode($data))
        );
    }
}
