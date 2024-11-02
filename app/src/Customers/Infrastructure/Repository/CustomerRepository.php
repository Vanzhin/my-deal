<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Repository;

use App\Customers\Domain\Aggregate\Customer\Customer;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function add(Customer $customer): void
    {
        $this->getEntityManager()->persist($customer);
        $this->getEntityManager()->flush();
    }

    public function findOneByTin(string $tin): ?Customer
    {
        // TODO: Implement findOneByTin() method.
    }

    public function findOneKontragentId(int $kontragentId): ?Customer
    {
        // TODO: Implement findOneKontragentId() method.
    }
}