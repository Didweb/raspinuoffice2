<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class SupplierThisIdExists  extends HttpException
{
    public static function ofId(SupplierId $supplierId): self
    {
        return new self(
            204,
            sprintf('Supplier with id <%s> it already exists', (string)$supplierId)
        );
    }
}