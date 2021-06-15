<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Services;


use RaspinuOffice\Backoffice\Products\Style\Application\Command\CreateStyleCommand;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

final class CreateStyle
{
    private StyleRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;

    public function __construct(StyleRepository $repository, ThisNameAlreadyExists $thisNameAlreadyExists)
    {
        $this->repository = $repository;
        $this->thisNameAlreadyExists = $thisNameAlreadyExists;
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

    }
}