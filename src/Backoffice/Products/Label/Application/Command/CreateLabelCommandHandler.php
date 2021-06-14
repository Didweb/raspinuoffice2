<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Application\Command;


use RaspinuOffice\Backoffice\Products\Label\Application\Services\CreateLabel;

final class CreateLabelCommandHandler
{
    private CreateLabel $createLabel;

    public function __construct(CreateLabel $createLabel)
    {
        $this->createLabel = $createLabel;
    }

    public function __invoke(CreateLabelCommand $command): void
    {
        $this->createLabel->__invoke($command);
    }

}