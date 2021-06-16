<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Event;


use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class StyleWasCreatedEventHandler  implements MessageHandlerInterface
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $eventsLogger)
    {
        $this->logger = $eventsLogger;
    }

    public function __invoke(StyleWasCreatedEvent $event): void
    {

        $this->logger->info('Created new Style: '.$event->name(),['products.style']);
    }
}