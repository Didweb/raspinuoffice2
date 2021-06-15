<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Persistence\Doctrine\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;

final class StyleIdType
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

        return StyleId::create($value);
    }
}