<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects;


use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class StyleIdStub
{
    public static function random(): StyleId
    {
        return StyleId::create(Faker::uuid());
    }

    public static function create(string $id): StyleId
    {
        return StyleId::create($id);
    }
}