<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class LabelThisIdExists  extends HttpException
{
    public static function ofId(LabelId $labelId): self
    {
        return new self(204,
                        sprintf('Label with id <%s> it already exists', (string)$labelId)
        );
    }
}