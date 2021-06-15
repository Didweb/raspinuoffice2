<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class StyleThisIdExists  extends HttpException
{
    public static function ofId(StyleId $styleId): self
    {
        return new self(204,
                        sprintf('Style with id <%s> it already exists', (string)$styleId)
        );
    }
}