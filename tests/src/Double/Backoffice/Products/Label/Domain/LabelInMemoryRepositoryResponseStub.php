<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelResponseRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;
use RaspinuOffice\Backoffice\Products\Label\Infrastructure\Response\PaginatedLabelResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class LabelInMemoryRepositoryResponseStub
{
    public static function empty(PaginatedLabelResponseConverter $paginatedLabelResponseConverter
    ): LabelResponseRepository {
        return self::repository([], $paginatedLabelResponseConverter);
    }

    private static function repository(array $crmData, $paginatedLabelResponseConverter): LabelResponseRepository
    {
        return (
        new class($crmData, $paginatedLabelResponseConverter) implements LabelResponseRepository {
            private ArrayCollection $arrayCollection;
            private PaginatedLabelResponseConverter $paginatedLabelResponseConverter;

            public function __construct(
                ?array $crmData,
                PaginatedLabelResponseConverter $paginatedLabelResponseConverter
            ) {
                $this->arrayCollection = new ArrayCollection($crmData);
                $this->paginatedLabelResponseConverter = $paginatedLabelResponseConverter;
            }


            public function save(Label $label): void
            {
                if ($this->arrayCollection->contains($label)) {
                    $this->arrayCollection->removeElement($label);
                    $this->arrayCollection->add($label);
                } else {
                    $this->arrayCollection->add($label);
                }
            }

            public function findBy(LabelId $id): ?Label
            {
                $filter = $this->arrayCollection->filter(
                    function (Label $label) use ($id) {
                        return $label->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function allLabel(Paginated $paginated): PaginatedResponse
            {
                $allLabelItemes = $this->arrayCollection->toArray();

                $page = $paginated->page();
                $pageSize = $paginated->pageSize();
                $offset = ($page > 1) ? ($page-1) * ($pageSize) : 0;
                $genrePaginated = array_slice($allLabelItemes, $offset, $pageSize, true);

                return $this->paginatedLabelResponseConverter->__invoke(
                    PaginatedCollection::createFromArray($genrePaginated, count($allLabelItemes)),
                    $paginated
                );
            }


        }
        );
    }
}