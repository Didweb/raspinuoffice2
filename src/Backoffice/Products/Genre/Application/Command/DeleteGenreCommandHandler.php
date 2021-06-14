<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Command;


use RaspinuOffice\Backoffice\Products\Genre\Application\Services\DeleteGenre;

final class DeleteGenreCommandHandler
{
    private DeleteGenre $deleteGenre;

    public function __construct(DeleteGenre $deleteGenre)
    {
        $this->deleteGenre = $deleteGenre;
    }

    public function __invoke(DeleteGenreCommand $command): void
    {
        $this->deleteGenre->__invoke($command);
    }

}