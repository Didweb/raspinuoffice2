<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\ValueObjects;


final class LabelStub
{
    public static function random(): Label
    {
        return new Label(
            LabelIdStub::random(),
            LabelNameStub::random()
        );
    }
}