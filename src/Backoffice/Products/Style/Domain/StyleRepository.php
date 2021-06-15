<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Domain;

use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

interface StyleRepository
{
    public function save(Style $style): void;

    public function findByName(StyleName $name): ?Style;

    public function remove(Style $style): void;
}