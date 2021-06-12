<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreName;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class GenreThisNameAlreadyExist extends HttpException
{
    public static function ofName(GenreName $genreName): self
    {
        return new self(204,
                        sprintf('Genre with name <%s> it already exists', (string)$genreName)
        );
    }
}