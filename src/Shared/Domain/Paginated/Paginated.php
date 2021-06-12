<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Domain\Paginated;


use InvalidArgumentException;

final class Paginated
{
    const PAGE_SIZE = 50;
    const PAGE_MAX_SIZE = 500;

    private int $page;
    private int $pageSize;
    private int $offset;

    public function __construct(int $page, int $pageSize, int $offset)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->offset = $offset;
    }

    public static function create(int $page = 1, ?int $pageSize = null): self
    {
        if ($page <= 0) {
            throw new InvalidArgumentException(
                'Parameter \'page\' must be a positive integer.'
            );
        }

        $pageSize = !empty($pageSize) ? $pageSize : self::PAGE_SIZE;

        if ($pageSize > self::PAGE_MAX_SIZE) {
            throw new InvalidArgumentException(
                sprintf('Parameter page size must be less than <%s>.', self::PAGE_MAX_SIZE)
            );
        }

        $offset = $pageSize * ($page - 1);

        return new self(
            $page,
            $pageSize,
            $offset
        );
    }

    public function page(): int
    {
        return $this->page;
    }

    public function pageSize(): int
    {
        return $this->pageSize;
    }

    public function offset(): int
    {
        return $this->offset;
    }

}