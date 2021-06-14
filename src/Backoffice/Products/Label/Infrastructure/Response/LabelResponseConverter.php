<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Label\Domain\Label;

final class LabelResponseConverter
{
    public function __invoke(Label $genre): LabelResponse
    {
        return new LabelResponse(
            (string)$genre->id(),
            (string)$genre->name()
        );
    }
}