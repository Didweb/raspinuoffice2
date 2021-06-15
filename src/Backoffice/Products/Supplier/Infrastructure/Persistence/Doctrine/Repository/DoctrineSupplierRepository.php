<?php

declare(strict_types=1);

namespace RaspinuOffice\Backoffice\Products\Supplier\Infrastructure\Persistence\Doctrine\Repository;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\Supplier;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\SupplierRepository;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierId;
use RaspinuOffice\Backoffice\Products\Supplier\Domain\ValueObjects\SupplierName;

final class DoctrineSupplierRepository implements SupplierRepository
{
    private EntityManagerInterface $em;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
        /** @var EntityRepository $repository */
        $repository = $this->em->getRepository(Supplier::class);
        $this->repository = $repository;
    }

    public function save(Supplier $label): void
    {
        $this->em->persist($label);
        $this->em->flush();
    }

    public function findBy(SupplierId $id): ?Supplier
    {
        return $this->repository->find($id);
    }

    public function findByName(SupplierName $name): ?Supplier
    {
        return $this->repository->findOneBy(['name' => $name]);
    }

    public function remove(Supplier $label): void
    {
        $this->em->remove($label);
        $this->em->flush();
    }
}