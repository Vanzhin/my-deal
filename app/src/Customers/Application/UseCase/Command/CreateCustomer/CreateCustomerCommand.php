<?php

declare(strict_types=1);


namespace App\Customers\Application\UseCase\Command\CreateCustomer;

use App\Shared\Application\Command\Command;

readonly class CreateCustomerCommand extends Command
{
    public function __construct(
        public string $tin,
    )
    {
    }
}
