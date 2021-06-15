<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierResponseRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response\PaginatedSupplierResponseConverter;
use RaspinuOffice\Shared\Domain\Paginated\Paginated;
use RaspinuOffice\Shared\Domain\Paginated\PaginatedResponse;
use RaspinuOffice\Shared\Infrastructure\Paginated\PaginatedCollection;

final class SupplierInMemoryRepositoryResponseStub
{
    public static function empty(PaginatedSupplierResponseConverter $paginatedSupplierResponseConverter
    ): SupplierResponseRepository {
        return self::repository([], $paginatedSupplierResponseConverter);
    }

    private static function repository(array $crmData, $paginatedSupplierResponseConverter): SupplierResponseRepository
    {
        return (
        new class($crmData, $paginatedSupplierResponseConverter) implements SupplierResponseRepository {
            private ArrayCollection $arrayCollection;
            private PaginatedSupplierResponseConverter $paginatedSupplierResponseConverter;

            public function __construct(
                ?array $crmData,
                PaginatedSupplierResponseConverter $paginatedSupplierResponseConverter
            ) {
                $this->arrayCollection = new ArrayCollection($crmData);
                $this->paginatedSupplierResponseConverter = $paginatedSupplierResponseConverter;
            }


            public function save(Supplier $supplier): void
            {
                if ($this->arrayCollection->contains($supplier)) {
                    $this->arrayCollection->removeElement($supplier);
                    $this->arrayCollection->add($supplier);
                } else {
                    $this->arrayCollection->add($supplier);
                }
            }

            public function findBy(SupplierId $id): ?Supplier
            {
                $filter = $this->arrayCollection->filter(
                    function (Supplier $supplier) use ($id) {
                        return $supplier->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }


            public function allSupplier(Paginated $paginated): PaginatedResponse
            {
                $allSupplierItemes = $this->arrayCollection->toArray();

                $page = $paginated->page();
                $pageSize = $paginated->pageSize();
                $offset = ($page > 1) ? ($page-1) * ($pageSize) : 0;
                $genrePaginated = array_slice($allSupplierItemes, $offset, $pageSize, true);

                return $this->paginatedSupplierResponseConverter->__invoke(
                    PaginatedCollection::createFromArray($genrePaginated, count($allSupplierItemes)),
                    $paginated
                );
            }
        }
        );
    }
}