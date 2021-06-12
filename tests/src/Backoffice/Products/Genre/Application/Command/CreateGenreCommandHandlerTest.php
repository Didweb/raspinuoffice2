<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Genre\Application;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\CreateGenreCommand;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\CreateGenreCommandHandler;
use RaspinuOffice\Backoffice\Products\Genre\Application\Services\CreateGenre;
use RaspinuOffice\Backoffice\Products\Genre\Application\Services\ThisNameAlreadyExists;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions\GenreThisNameAlreadyExist;
use RaspinuOffice\Backoffice\Products\Genre\Domain\GenreRepository;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenerInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenreStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreIdStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreNameStub;

final class CreateGenreCommandHandlerTest extends TestCase
{

    private CreateGenreCommandHandler $SUT;
    private CreateGenre $useCase;
    private GenreRepository $repository;
    private ThisNameAlreadyExists $thisNameAlreadyExists;
    private $genreInit;

    protected function setUp(): void
    {
        $this->repository = GenerInMemoryRepositoryStub::empty();
        $this->thisNameAlreadyExists = new ThisNameAlreadyExists($this->repository);
        $this->useCase = $this->createMock(CreateGenre::class);
        $this->SUT = new CreateGenreCommandHandler($this->useCase);


        $this->genreInit = GenreStub::random();
        $this->repository->save($this->genreInit);

        parent::setUp();
    }

    public function test_should_create_genre(): void
    {
        $command = new CreateGenreCommand(
            (string)GenreIdStub::random(),
            (string)GenreNameStub::random()
        );

        $this->useCase
            ->expects($this->once())
            ->method('__invoke');

        $this->SUT->__invoke($command);
    }

    public function test_should_create_genre_when_name_exists(): void
    {
        $this->expectException(GenreThisNameAlreadyExist::class);

        $useCase = new CreateGenre($this->repository, $this->thisNameAlreadyExists);

        $genre2 = GenreStub::create($this->genreInit->id(), $this->genreInit->name());

        $command = new CreateGenreCommand(
            (string)$genre2->id(),
            (string)$genre2->name()
        );

        $useCase->__invoke($command);
    }
}