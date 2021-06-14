<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Label\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\Label;
use RaspinuOffice\Backoffice\Products\Label\Domain\LabelRepository;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelId;
use RaspinuOffice\Backoffice\Products\Label\Domain\ValueObjects\LabelName;

final class DoctrineLabelRepository implements LabelRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Label::class);
        $this->repository = $repository;
    }

    public function save(Label $label): void
    {
        $this->em->persist($label);
        $this->em->flush();
    }

    public function findBy(LabelId $id): ?Label
    {
        return $this->repository->find($id);
    }

    public function findByName(LabelName $name): ?Label
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    public function remove(Label $label): void
    {
        $this->em->remove($label);
        $this->em->flush();
    }
}