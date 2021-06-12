<?php

declare(strict_types=1);

namespace RaspinuOffice\Shared\Infrastructure\Paginated;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Shared\Application\Paginated\PaginatedResponseInfo;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;

final class PaginatedResponseDoctrine implements PaginatedResponse
{
    private ArrayCollection $data;
    private PaginatedResponseInfo $info;

    public function __construct(ArrayCollection $data, PaginatedResponseInfo $info)
    {
        $this->data = $data;
        $this->info = $info;
    }

    public static function create(
        ArrayCollection $collection,
        int $perPage,
        int $count,
        int $countAll,
        int $page
    ): self {
        return new self(
            $collection,
            PaginatedResponseInfo::create(
                $perPage,
                $count,
                $countAll,
                $page
            )
        );
    }

    public function data(): ArrayCollection
    {
        return $this->data;
    }


}