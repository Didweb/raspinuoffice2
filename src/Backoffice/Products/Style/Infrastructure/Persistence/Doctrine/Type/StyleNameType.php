<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Persistence\Doctrine\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;

final class StyleNameType
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

        return new StyleName($value);
    }
}