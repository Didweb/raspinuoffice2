<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Supplier\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\DeleteSupplierCommand;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\DeleteSupplierCommandHandler;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\DeleteSupplier;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\DoesThisIdExist;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions\SupplierThisIdExists;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierIdStub;

final class DeleteSupplierCommandHandlerTest extends TestCase
{
    private $repository;
    private DoesThisIdExist $thisNameAlreadyExists;
    private Supplier $supplierInit;
    private $useCase;
    private DeleteSupplierCommandHandler $SUT;

    protected function setUp(): void
    {
        $this->repository = SupplierInMemoryRepositoryStub::empty();

        $this->supplierInit = SupplierStub::random();
        $this->repository->save($this->supplierInit);

        $doesThisIdExist = new DoesThisIdExist($this->repository);
        $this->useCase = new DeleteSupplier($this->repository, $doesThisIdExist);
        $this->SUT = new DeleteSupplierCommandHandler($this->useCase);

        parent::setUp();
    }


    public function test_should_delete_supplier(): void
    {
        $checkSupplier = $this->repository->find($this->supplierInit->id());
        $this->assertEquals((string)$this->supplierInit->id(), (string)$checkSupplier->id());

        $command = new DeleteSupplierCommand(
            (string)$this->supplierInit->id()
        );

        $this->SUT->__invoke($command);

        $checkDeleteSupplier = $this->repository->find($this->supplierInit->id());

        $this->assertNull($checkDeleteSupplier);
    }

    public function test_should_not_delete_supplier_when_supplier_not_exist(): void
    {
        $this->expectException(SupplierThisIdExists::class);

        $command = new DeleteSupplierCommand(
            (string)SupplierIdStub::random()
        );

        $this->SUT->__invoke($command);
    }
}