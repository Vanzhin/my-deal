<?php

declare(strict_types=1);


namespace App\Customers\Application\UseCase\Command\CreateCustomer;

class CreateCustomerCommandResult
{
    public function __construct(
        public string $id,
    )
    {
    }
}
