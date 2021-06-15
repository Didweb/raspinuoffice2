<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponseDoctrine;

final class PaginatedStyleResponseConverter
{
    private StyleResponseConverter $styleResponseConverter;

    public function __construct(StyleResponseConverter $styleResponseConverter)
    {
        $this->styleResponseConverter = $styleResponseConverter;
    }
    public function __invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponseDoctrine
    {
        $labels = $paginatedCollection->map(
            function (Style $label) {
                return $this->styleResponseConverter->__invoke($label);
            }
        );

        return PaginatedResponseDoctrine::create(
            $labels,
            $paginated->pageSize(),
            $paginatedCollection->totalCollection(),
            $paginatedCollection->total(),
            $paginated->page()
        );
    }
}