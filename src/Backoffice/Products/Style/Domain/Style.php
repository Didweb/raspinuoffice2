<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Domain;


use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

final class Style
{
    private StyleId $id;
    private StyleName $name;

    public function __construct(StyleId $id, StyleName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): StyleId
    {
        return $this->id;
    }

    public function name(): StyleName
    {
        return $this->name;
    }
}