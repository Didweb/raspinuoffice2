<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Style;


use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects\StyleIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects\StyleNameStub;

final class StyleStub
{
    public static function random(): Style
    {
        return new Style(
            StyleIdStub::random(),
            StyleNameStub::random()
        );
    }


    public static function create(StyleId $id, StyleName $name): Style
    {
        return new Style($id,$name);
    }
}