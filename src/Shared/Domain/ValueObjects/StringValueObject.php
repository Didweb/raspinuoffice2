<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\ValueObjects;


class StringValueObject
{
    protected $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->value();
    }
}