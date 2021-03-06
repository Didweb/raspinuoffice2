<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\Bus\Event;


use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventBus implements EventBus
{
    use HandleTrait {
        handle as handleEvent;
    }

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->messageBus = $eventBus;
    }

    /** @return mixed */
    public function dispatch(Event $event)
    {
        return $this->handleEvent($event);
    }
}