<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Domain;

use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;

interface LabelRepository
{
    public function save(Label $label): void;

    public function findByName(LabelName $name): ?Label;
}