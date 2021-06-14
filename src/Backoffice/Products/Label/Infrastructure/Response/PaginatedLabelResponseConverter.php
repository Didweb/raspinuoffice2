<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response;


use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedResponseDoctrine;

final class PaginatedLabelResponseConverter
{
    private LabelResponseConverter $labelResponseConverter;

    public function __construct(LabelResponseConverter $labelResponseConverter)
    {
        $this->labelResponseConverter = $labelResponseConverter;
    }
    public function __invoke(PaginatedCollection $paginatedCollection, Paginated $paginated): PaginatedResponseDoctrine
    {
        $labels = $paginatedCollection->map(
            function (Label $label) {
                return $this->labelResponseConverter->__invoke($label);
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