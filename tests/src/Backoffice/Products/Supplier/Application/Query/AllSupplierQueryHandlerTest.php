<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Supplier\Application\Query;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Query\AllSupplierQuery;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Query\AllSupplierQueryHandler;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\FindAllSupplier;
use RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response\PaginatedSupplierResponseConverter;
use RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Response\SupplierResponseConverter;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierInMemoryRepositoryResponseStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierStub;

final class AllSupplierQueryHandlerTest extends TestCase
{
    private $useCase;
    private AllSupplierQueryHandler $SUT;
    private array $supplierRandom;

    protected function setUp(): void
    {
        parent::setUp();
        $supplierResponseConverter = new SupplierResponseConverter();
        $paginatedSupplierResponseConverter = new PaginatedSupplierResponseConverter($supplierResponseConverter);
        $repositoryResponse = SupplierInMemoryRepositoryResponseStub::empty($paginatedSupplierResponseConverter);


        $this->useCase = new FindAllSupplier($repositoryResponse);
        $this->SUT = new AllSupplierQueryHandler($repositoryResponse);


        for ($n = 0; $n < 20;) {
            $supplier = SupplierStub::random();
            $this->supplierRandom[$n] = $supplier;

            $repositoryResponse->save($supplier);
            $n++;
        }
    }

    public function test_should_list_all_label_page_1(): void
    {
        $query = new AllSupplierQuery(1,5);

        $result = $this->SUT->__invoke($query);
        $idRandom = rand(0,4);
        $this->assertEquals((string)$this->supplierRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }

    public function test_should_list_all_genre_page_2(): void
    {
        $query = new AllSupplierQuery(2,5);

        $result = $this->SUT->__invoke($query);

        $idRandom = rand(5,9);
        $this->assertEquals((string)$this->supplierRandom[$idRandom]->name(), (string)$result->data()[$idRandom]->name());
    }
}