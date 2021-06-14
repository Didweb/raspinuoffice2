<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Domain;

use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

interface GenreRepository
{
    public function save(Genre $genre): void;

    public function findBy(GenreId $id): ?Genre;

    public function findByName(GenreName $name): ?Genre;

    public function remove(Genre $genre): void;
}