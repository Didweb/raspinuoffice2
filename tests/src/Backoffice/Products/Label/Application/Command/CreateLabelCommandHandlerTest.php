<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Label\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\CreateLabelCommand;
use RaspinuOffice\Backoffice\Products\Label\Application\Command\CreateLabelCommandHandler;
use RaspinuOffice\Backoffice\Products\Label\Application\Services\CreateLabel;
use RaspinuOffice\Backoffice\Products\Label\Application\Services\ThisNameAlreadyExists;
use RaspinuOffice\Backoffice\Products\Label\Domain\Exceptions\LabelThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\LabelStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\ValueObjects\LabelIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Label\Domain\ValueObjects\LabelNameStub;

final class CreateLabelCommandHandlerTest extends TestCase
{
    private CreateLabelCommandHandler $SUT;
    private CreateLabel $useCase;
    private LabelRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;
    private $labelInit;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = LabelInMemoryRepositoryStub::empty();
        $this->thisNameAlreadyExists = new ThisNameAlreadyExists($this->repository);
        $this->useCase = new CreateLabel($this->repository,$this->thisNameAlreadyExists);
        $this->SUT = new CreateLabelCommandHandler($this->useCase);

        $this->labelInit = LabelStub::random();

    }

    public function test_should_create_label(): void
    {
        $command = new CreateLabelCommand(
            (string)LabelIdStub::random(),
            (string)LabelNameStub::random()
        );

        $this->SUT->__invoke($command);

        $labelInMemory = $this->repository->findBy(LabelIdStub::create($command->id()));

        $this->assertEquals((string)$command->id(), (string)$labelInMemory->id());
    }

    public function test_should_create_label_when_name_exists(): void
    {
        $this->repository->save($this->labelInit);
        $this->expectException(LabelThisNameAlreadyExist::class);

        $useCase = new CreateLabel($this->repository, $this->thisNameAlreadyExists);

        $label2 = LabelStub::create($this->labelInit->id(), $this->labelInit->name());

        $command = new CreateLabelCommand(
            (string)$label2->id(),
            (string)$label2->name()
        );

        $useCase->__invoke($command);
    }
}