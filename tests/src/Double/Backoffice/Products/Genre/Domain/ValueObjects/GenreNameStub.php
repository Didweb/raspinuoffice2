<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects;


use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class GenreNameStub
{
    public static function random(): GenreName
    {
        return new GenreName(Faker::word());
    }

    public static function create(string $name): GenreName
    {
        return new GenreName($name);
    }
}