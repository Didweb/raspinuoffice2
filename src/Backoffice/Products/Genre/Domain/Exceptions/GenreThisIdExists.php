<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions;


use RaspinuOffice\Backoffice\Products\Genre\Domain\ValueObjects\GenreId;
use Symfony\Component\HttpKernel\Exception\HttpException;

final class GenreThisIdExists extends HttpException
{
    public static function ofId(GenreId $genreId): self
    {
        return new self(204,
                        sprintf('Genre with id <%s> it already exists', (string)$genreId)
        );
    }
}