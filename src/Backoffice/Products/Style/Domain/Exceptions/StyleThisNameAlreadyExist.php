<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class StyleThisNameAlreadyExist extends HttpException
{
    public static function ofName(StyleName $styleName): self
    {
        return new self(
            204,
            sprintf('Style with name <%s> it already exists', (string)$styleName)
        );
    }
}