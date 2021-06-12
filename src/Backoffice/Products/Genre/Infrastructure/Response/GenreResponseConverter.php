<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;

final class GenreResponseConverter
{
    public function __invoke(Genre $genre): GenreResponse
    {
        return new GenreResponse(
            (string)$genre->id(),
            (string)$genre->name()
        );
    }
}