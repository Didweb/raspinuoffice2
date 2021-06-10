<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Domain;

use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

final class Genre
{
    private GenreId $id;
    private GenreName $name;

    public function __construct(GenreId $id, GenreName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): GenreId
    {
        return $this->id;
    }

    public function name(): GenreName
    {
        return $this->name;
    }
}