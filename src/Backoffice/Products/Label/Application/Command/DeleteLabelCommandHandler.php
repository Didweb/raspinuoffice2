<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Command;


use RaspinuOffice\Backoffice\Products\Label\Application\Services\DeleteLabel;

final class DeleteLabelCommandHandler
{
    private DeleteLabel $deleteLabel;

    public function __construct(DeleteLabel $deleteLabel)
    {
        $this->deleteLabel = $deleteLabel;
    }

    public function __invoke(DeleteLabelCommand $command): void
    {
        $this->deleteLabel->__invoke($command);
    }

}