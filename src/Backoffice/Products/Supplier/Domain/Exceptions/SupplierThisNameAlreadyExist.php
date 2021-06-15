<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class SupplierThisNameAlreadyExist extends HttpException
{
    public static function ofName(SupplierName $labelName): self
    {
        return new self(
            204,
            sprintf('Supplier with name <%s> it already exists', (string)$labelName)
        );
    }
}