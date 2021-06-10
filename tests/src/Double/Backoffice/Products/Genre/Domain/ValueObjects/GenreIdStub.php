<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects;


use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class GenreIdStub
{
    public static function random(): GenreId
    {
        return GenreId::create(Faker::uuid());
    }

    public static function create(string $id): GenreId
    {
        return GenreId::create($id);
    }
}