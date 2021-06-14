<?php

declare(strict_types=1);

namespace RaspinuOffice\Tests\Backoffice\Products\Genre\Application\Command;


use PHPUnit\Framework\TestCase;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\DeleteGenreCommand;
use RaspinuOffice\Backoffice\Products\Genre\Application\Command\DeleteGenreCommandHandler;
use RaspinuOffice\Backoffice\Products\Genre\Application\Services\DeleteGenre;
use RaspinuOffice\Backoffice\Products\Genre\Application\Services\DoesThisIdExist;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Exceptions\GenreThisIdExists;
use RaspinuOffice\Backoffice\Products\Genre\Domain\Genre;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenerInMemoryRepositoryStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\GenreStub;
use RaspinuOffice\Tests\Double\Backoffice\Products\Genre\Domain\ValueObjects\GenreIdStub;

final class DeleteGenreCommandHandlerTest extends TestCase
{
    private $repository;
    private DoesThisIdExist $thisNameAlreadyExists;
    private Genre $genreInit;
    private $useCase;
    private DeleteGenreCommandHandler $SUT;

    protected function setUp(): void
    {
        $this->repository = GenerInMemoryRepositoryStub::empty();

        $this->genreInit = GenreStub::random();
        $this->repository->save($this->genreInit);

        $doesThisIdExist = new DoesThisIdExist($this->repository);
        $this->useCase = new DeleteGenre($this->repository, $doesThisIdExist);
        $this->SUT = new DeleteGenreCommandHandler($this->useCase);

        parent::setUp();
    }

    public function test_should_delete_genre(): void
    {
        $command = new DeleteGenreCommand(
            (string)$this->genreInit->id()
        );

        $this->SUT->__invoke($command);

        $checkDeleteGenre = $this->repository->find($this->genreInit->id());

        $this->assertNull($checkDeleteGenre);
    }

    public function test_should_not_delete_genre_when_genre_not_exist(): void
    {
        $this->expectException(GenreThisIdExists::class);

        $command = new DeleteGenreCommand(
            (string)GenreIdStub::random()
        );

        $this->SUT->__invoke($command);
    }
}