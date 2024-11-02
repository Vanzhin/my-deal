<?php
declare(strict_types=1);


namespace App\Customers\Domain\Factory;

use App\Customers\Domain\Aggregate\Customer\Customer;
use App\Customers\Domain\Aggregate\Customer\Specification\CustomerSpecification;

class CustomerFactory
{
    public function __construct(
        private readonly CustomerSpecification $specification,
    )
    {
    }

    public function create(string $tin, int $kontragentId): Customer
    {
        return new Customer($tin, $kontragentId, $this->specification);
    }
}