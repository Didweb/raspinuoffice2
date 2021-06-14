<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Label\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\DeleteLabelCommand;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\DeleteLabelCommandHandler;
use RaspinuOffice\Backoffice\Products\Label\Application\Services\DeleteLabel;
use RaspinuOffice\Backoffice\Products\Label\Application\Services\DoesThisIdExist;
use RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions\LabelThisIdExists;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\ValueObjects\LabelIdStub;

final class DeleteLabelCommandHandlerTest extends TestCase
{
    private $repository;
    private DoesThisIdExist $thisNameAlreadyExists;
    private Label $labelInit;
    private $useCase;
    private DeleteLabelCommandHandler $SUT;

    protected function setUp(): void
    {
        $this->repository = LabelInMemoryRepositoryStub::empty();

        $this->labelInit = LabelStub::random();
        $this->repository->save($this->labelInit);

        $doesThisIdExist = new DoesThisIdExist($this->repository);
        $this->useCase = new DeleteLabel($this->repository, $doesThisIdExist);
        $this->SUT = new DeleteLabelCommandHandler($this->useCase);

        parent::setUp();
    }


    public function test_should_delete_label(): void
    {
        $checkLabel = $this->repository->find($this->labelInit->id());
        $this->assertEquals((string)$this->labelInit->id(), (string)$checkLabel->id());

        $command = new DeleteLabelCommand(
            (string)$this->labelInit->id()
        );

        $this->SUT->__invoke($command);

        $checkDeleteLabel = $this->repository->find($this->labelInit->id());

        $this->assertNull($checkDeleteLabel);
    }

    public function test_should_not_delete_label_when_label_not_exist(): void
    {
        $this->expectException(LabelThisIdExists::class);

        $command = new DeleteLabelCommand(
            (string)LabelIdStub::random()
        );

        $this->SUT->__invoke($command);
    }
}