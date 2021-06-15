<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain;


use Doctrine\Common\Collections\ArrayCollection;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

final class SupplierInMemoryRepositoryStub
{
    public static function empty(): SupplierRepository
    {
        return self::repository([]);
    }

    private static function repository(array $crmData): SupplierRepository
    {
        return (
        new class($crmData) implements SupplierRepository
        {
            private ArrayCollection $arrayCollection;

            public function __construct(?array $crmData)
            {
                $this->arrayCollection = new ArrayCollection($crmData);
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

            public function findByName(SupplierName $supplierName): ?Supplier
            {
                $filter = $this->arrayCollection->filter(
                    function (Supplier $label) use ($supplierName) {

                        return  (string)$label->name() == $supplierName;
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function find(SupplierId $id): ?Supplier
            {
                $filter = $this->arrayCollection->filter(
                    function (Supplier $supplier) use ($id) {
                        return $supplier->id()->equals($id);
                    }
                );

                return $filter->count() ? $filter->first() : null;
            }

            public function remove(Supplier $supplier): void
            {
                $this->arrayCollection->removeElement($supplier);
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
        }
        );
    }
}