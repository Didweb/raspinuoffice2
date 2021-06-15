<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Application\Command;


use RaspinuOffice\Backoffice\Products\Style\Application\Services\CreateStyle;

final class CreateStyleCommandHandler
{
    private CreateStyle $createStyle;

    public function __construct(CreateStyle $createStyle)
    {
        $this->createStyle = $createStyle;
    }

    public function __invoke(CreateStyleCommand $command): void
    {
        $this->createStyle->__invoke($command);
    }
}