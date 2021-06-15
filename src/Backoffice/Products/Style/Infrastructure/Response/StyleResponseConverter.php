<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Style\Domain\Style;

final class StyleResponseConverter
{
    public function __invoke(Style $genre): StyleResponse
    {
        return new StyleResponse(
            (string)$genre->id(),
            (string)$genre->name()
        );
    }
}