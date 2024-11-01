<?php
declare(strict_types=1);


namespace App\Customers\Domain\Repository;

use App\Customers\Domain\Aggregate\Customer\Customer;

interface CustomerRepositoryInterface
{
    public function add(Customer $customer): void;

    public function findOneByTin(string $tin): ?Customer;

    public function findOneKontragentId(int $kontragentId): ?Customer;

}