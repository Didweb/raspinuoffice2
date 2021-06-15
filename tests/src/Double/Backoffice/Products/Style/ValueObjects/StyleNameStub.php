<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects;


use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class StyleNameStub
{
    public static function random(): StyleName
    {
        return new StyleName(Faker::word());
    }

    public static function create(string $name): StyleName
    {
        return new StyleName($name);
    }
}