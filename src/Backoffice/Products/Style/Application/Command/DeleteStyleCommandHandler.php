<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Command;


use RaspinuOffice\Backoffice\Products\Style\Application\Services\DeleteStyle;

final class DeleteStyleCommandHandler
{
    private DeleteStyle $deleteStyle;

    public function __construct(DeleteStyle $deleteStyle)
    {
        $this->deleteStyle = $deleteStyle;
    }
    public function __invoke(DeleteStyleCommand $command): void
    {
        $this->deleteStyle->__invoke($command);
    }
}