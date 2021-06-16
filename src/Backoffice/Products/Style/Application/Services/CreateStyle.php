<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;


use RaspinuOffice\Backoffice\Products\Style\Application\Command\CreateStyleCommand;
use RaspinuOffice\Backoffice\Products\Style\Application\Event\StyleWasCreatedEvent;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;
use RaspinuOffice\Shared\Domain\Bus\Event\MessengerEventBus;

final class CreateStyle
{
    private StyleRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;
    private  $eventBus;

    public function __construct(StyleRepository $repository, ThisNameAlreadyExists $thisNameAlreadyExists,
        MessengerEventBus $eventBus)
    {
        $this->repository = $repository;
        $this->thisNameAlreadyExists = $thisNameAlreadyExists;
        $this->eventBus = $eventBus;
    }

    public function __invoke(CreateStyleCommand $command): void
    {
        $styleName = new StyleName($command->name());

        $this->thisNameAlreadyExists->__invoke($styleName);

        $style = new Style(
            StyleId::create($command->id()),
            $styleName
        );

        $this->repository->save($style);

        $this->eventBus->dispatch(new StyleWasCreatedEvent($command->name()));

    }
}