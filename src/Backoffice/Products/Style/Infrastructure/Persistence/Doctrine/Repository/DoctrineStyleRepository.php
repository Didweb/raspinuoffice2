<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Style\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\Style;
use RaspinuOffice\Backoffice\Products\Style\Domain\StyleRepository;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleId;
use RaspinuOffice\Backoffice\Products\Style\Domain\ValueObjects\StyleName;

final class DoctrineStyleRepository implements StyleRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Style::class);
        $this->repository = $repository;
    }

    public function save(Style $style): void
    {
        $this->em->persist($style);
        $this->em->flush();
    }

    public function findBy(StyleId $id): ?Style
    {
        return $this->repository->find($id);
    }

    public function findByName(StyleName $name): ?Style
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    public function remove(Style $style): void
    {
        $this->em->remove($style);
        $this->em->flush();
    }
}