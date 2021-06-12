<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain;

use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreNameStub;

final class GenreStub
{
    public static function random(): Genre
    {
        return new Genre(
            GenreIdStub::random(),
            GenreNameStub::random()
        );
    }

    public static function create(GenreId $id, GenreName $name): Genre
    {
        return new Genre(
            $id,
            $name
        );
    }

}