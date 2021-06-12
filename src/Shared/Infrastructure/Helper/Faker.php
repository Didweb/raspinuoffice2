<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Helper;

use Faker\Factory;

final class Faker
{
    public static function uuid(): string
    {
        return Factory::create()->uuid();
    }

    public static function word(): string
    {
        return Factory::create()->word();
    }
}