<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Command;


use RaspinuOffice\Backoffice\Products\Genre\Application\Services\CreateGenre;


final class CreateGenreCommandHandler
{
    private CreateGenre $createGenre;

    public function __construct(CreateGenre $createGenre)
    {
        $this->createGenre = $createGenre;
    }

    public function __invoke(CreateGenreCommand $command): void
    {
        $this->createGenre->__invoke($command);
    }
}