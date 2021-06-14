<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class LabelThisNameAlreadyExist extends HttpException
{
    public static function ofName(LabelName $labelName): self
    {
        return new self(
            204,
            sprintf('Label with name <%s> it already exists', (string)$labelName)
        );
    }
}