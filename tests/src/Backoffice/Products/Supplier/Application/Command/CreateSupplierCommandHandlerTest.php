<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Supplier\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions\LabelThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\CreateSupplierCommand;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Command\CreateSupplierCommandHandler;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\CreateSupplier;
use RaspinuOffice\Backoffice\Products\Supplier\Application\Services\ThisNameAlreadyExists;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Exceptions\SupplierThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\SupplierStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierNameStub;

final class CreateSupplierCommandHandlerTest extends TestCase
{
    private CreateSupplierCommandHandler $SUT;
    private CreateSupplier $useCase;
    private SupplierRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;
    private $supplierInit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = SupplierInMemoryRepositoryStub::empty();
        $this->thisNameAlreadyExists = new ThisNameAlreadyExists($this->repository);
        $this->useCase = new CreateSupplier($this->repository,$this->thisNameAlreadyExists);
        $this->SUT = new CreateSupplierCommandHandler($this->useCase);

        $this->supplierInit = SupplierStub::random();

    }

    public function test_should_create_label(): void
    {
        $command = new CreateSupplierCommand(
            (string)SupplierIdStub::random(),
            (string)SupplierNameStub::random()
        );

        $this->SUT->__invoke($command);

        $supplierInMemory = $this->repository->findBy(SupplierIdStub::create($command->id()));

        $this->assertEquals((string)$command->id(), (string)$supplierInMemory->id());
    }

    public function test_should_create_label_when_name_exists(): void
    {
        $this->repository->save($this->supplierInit);
        $this->expectException(SupplierThisNameAlreadyExist::class);

        $useCase = new CreateSupplier($this->repository, $this->thisNameAlreadyExists);

        $supplier2 = SupplierStub::create($this->supplierInit->id(), $this->supplierInit->name());

        $command = new CreateSupplierCommand(
            (string)$supplier2->id(),
            (string)$supplier2->name()
        );

        $useCase->__invoke($command);
    }
}