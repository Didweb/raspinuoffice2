<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Infrastructure\Persistence\Type;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;

final class LabelIdType extends StringType
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

        return LabelId::create($value);
    }
}