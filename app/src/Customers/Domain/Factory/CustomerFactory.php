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

    public function create(string $tin): Customer
    {
        return new Customer($tin, 1111111, $this->specification);
    }
}