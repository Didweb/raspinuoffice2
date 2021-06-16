<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\Bus\Event;


interface EventBus
{
    /** @return mixed */
    public function dispatch(Event $event);
}