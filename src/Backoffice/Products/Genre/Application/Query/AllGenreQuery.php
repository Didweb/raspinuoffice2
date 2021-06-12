<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Genre\Application\Query;


use RaspinuOffice\Shared\Domain\Bus\Query\Query;

final class AllGenreQuery implements Query
{
    private int $page;
    private int $pageSize;

    public function __construct(int $page, int $pageSize)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
    }

    public function page(): int
    {
        return $this->page;
    }

    public function pageSize(): int
    {
        return $this->pageSize;
    }
}