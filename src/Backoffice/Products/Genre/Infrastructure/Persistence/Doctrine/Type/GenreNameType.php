<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Infrastructure\Persistence\Doctrine\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;

final class GenreNameType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }
        return (string)$value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (!$value) {
            return null;
        }

        return new GenreName($value);
    }
}