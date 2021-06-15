<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Style\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\DeleteStyleCommand;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\DeleteStyleCommandHandler;
use RaspinuOffice\Backoffice\Products\Style\Application\Services\DeleteStyle;
use RaspinuOffice\Backoffice\Products\Style\Application\Services\DoesThisIdExist;
use RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions\StyleThisIdExists;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects\StyleIdStub;

final class DeleteStyleCommandHandlerTest extends TestCase
{
    private $repository;
    private DoesThisIdExist $thisNameAlreadyExists;
    private Style $styleInit;
    private $useCase;
    private DeleteStyleCommandHandler $SUT;

    protected function setUp(): void
    {
        $this->repository = StyleInMemoryRepositoryStub::empty();

        $this->styleInit = StyleStub::random();
        $this->repository->save($this->styleInit);

        $doesThisIdExist = new DoesThisIdExist($this->repository);
        $this->useCase = new DeleteStyle($this->repository, $doesThisIdExist);
        $this->SUT = new DeleteStyleCommandHandler($this->useCase);

        parent::setUp();
    }


    public function test_should_delete_style(): void
    {
        $checkLabel = $this->repository->find($this->styleInit->id());
        $this->assertEquals((string)$this->styleInit->id(), (string)$checkLabel->id());

        $command = new DeleteStyleCommand(
            (string)$this->styleInit->id()
        );

        $this->SUT->__invoke($command);

        $checkDeleteLabel = $this->repository->find($this->styleInit->id());

        $this->assertNull($checkDeleteLabel);
    }

    public function test_should_not_delete_style_when_style_not_exist(): void
    {
        $this->expectException(StyleThisIdExists::class);

        $command = new DeleteStyleCommand(
            (string)StyleIdStub::random()
        );

        $this->SUT->__invoke($command);
    }
}