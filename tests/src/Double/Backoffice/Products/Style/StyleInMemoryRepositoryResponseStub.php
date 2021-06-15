<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Style;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleResponseRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Infrastructure\Response\PaginatedStyleResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class StyleInMemoryRepositoryResponseStub
{
    public static function empty(PaginatedStyleResponseConverter $paginatedStyleResponseConverter
    ): StyleResponseRepository {
        return self::repository([], $paginatedStyleResponseConverter);
    }

    private static function repository(array $crmData, $paginatedStyleResponseConverter): StyleResponseRepository
    {
        return (
        new class($crmData, $paginatedStyleResponseConverter) implements StyleResponseRepository {
            private ArrayCollection $arrayCollection;
            private PaginatedStyleResponseConverter $paginatedStyleResponseConverter;

            public function __construct(
                ?array $crmData,
                PaginatedStyleResponseConverter $paginatedStyleResponseConverter
            ) {
                $this->arrayCollection = new ArrayCollection($crmData);
                $this->paginatedStyleResponseConverter = $paginatedStyleResponseConverter;
            }


            public function save(Style $style): void
            {
                if ($this->arrayCollection->contains($style)) {
                    $this->arrayCollection->removeElement($style);
                    $this->arrayCollection->add($style);
                } else {
                    $this->arrayCollection->add($style);
                }
            }

            public function findBy(StyleId $id): ?Style
            {
                $filter = $this->arrayCollection->filter(
                    function (Style $style) use ($id) {
                        return $style->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function allStyle(Paginated $paginated): PaginatedResponse
            {
                $allStyleItemes = $this->arrayCollection->toArray();

                $page = $paginated->page();
                $pageSize = $paginated->pageSize();
                $offset = ($page > 1) ? ($page - 1) * ($pageSize) : 0;
                $genrePaginated = array_slice($allStyleItemes, $offset, $pageSize, true);

                return $this->paginatedStyleResponseConverter->__invoke(
                    PaginatedCollection::createFromArray($genrePaginated, count($allStyleItemes)),
                    $paginated
                );
            }


        }
        );
    }
}