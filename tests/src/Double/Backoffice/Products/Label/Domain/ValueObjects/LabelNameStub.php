<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\ValueObjects;


use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;
use RaspinuOffice\Shared\Infrastructure\Helper\Faker;

final class LabelNameStub
{
    public static function random(): LabelName
    {
        return new LabelName(Faker::word());
    }

    public static function create(string $name): LabelName
    {
        return new LabelName($name);
    }
}