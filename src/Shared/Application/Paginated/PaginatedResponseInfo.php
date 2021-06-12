<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Application\Paginated;


final class PaginatedResponseInfo
{
    private int $perPage;
    private int $count;
    private int $countAll;
    private int $page;

    public function __construct(int $perPage, int $count, int $countAll, int $page)
    {
        $this->perPage = $perPage;
        $this->count = $count;
        $this->countAll = $countAll;
        $this->page = $page;
    }

    public static function create(int $perPage, int $count, int $countAll, int $page): self
    {
        return new self($perPage, $count, $countAll, $page);
    }
}