<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Style\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\CreateStyleCommand;
use RaspinuOffice\Backoffice\Products\Style\Application\Command\CreateStyleCommandHandler;
use RaspinuOffice\Backoffice\Products\Style\Application\Services\CreateStyle;
use RaspinuOffice\Backoffice\Products\Style\Application\Services\ThisNameAlreadyExists;
use RaspinuOffice\Backoffice\Products\Style\Domain\Exceptions\StyleThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Shared\Domain\Bus\Event\MessengerEventBus;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\StyleStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects\StyleIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Style\ValueObjects\StyleNameStub;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreateStyleCommandHandlerTest extends TestCase
{
    private CreateStyleCommandHandler $SUT;
    private CreateStyle $useCase;
    private StyleRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;
    private $styleInit;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|MessengerEventBus
     */
    private $eventBus;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = StyleInMemoryRepositoryStub::empty();
        $this->thisNameAlreadyExists = new ThisNameAlreadyExists($this->repository);
        $this->eventBus = $this->createMock(MessengerEventBus::class);
        $this->useCase = new CreateStyle($this->repository,$this->thisNameAlreadyExists, $this->eventBus);
        $this->SUT = new CreateStyleCommandHandler($this->useCase);

        $this->styleInit = StyleStub::random();

    }

    public function test_should_create_style(): void
    {
        $command = new CreateStyleCommand(
            (string)StyleIdStub::random(),
            (string)StyleNameStub::random()
        );

        $this->SUT->__invoke($command);

        $styleInMemory = $this->repository->findBy(StyleIdStub::create($command->id()));

        $this->assertEquals((string)$command->id(), (string)$styleInMemory->id());
    }

    public function test_should_create_style_when_name_exists(): void
    {
        $this->repository->save($this->styleInit);
        $this->expectException(StyleThisNameAlreadyExist::class);

        $useCase = new CreateStyle($this->repository, $this->thisNameAlreadyExists, $this->eventBus);

        $styletesting = StyleStub::create($this->styleInit->id(), $this->styleInit->name());

        $command = new CreateStyleCommand(
            (string)$styletesting->id(),
            (string)$styletesting->name()
        );

        $useCase->__invoke($command);
    }
}