<?php

declare(strict_types=1);


namespace App\Customers\Application\UseCase\Command\CreateCustomer;

use App\Customers\Domain\Service\CustomerOrganizer;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateCustomerCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CustomerOrganizer $customerOrganizer,
    )
    {
    }

    public function __invoke(CreateCustomerCommand $command): CreateCustomerCommandResult
    {
        $result = $this->customerOrganizer->create($command->tin);

        return new CreateCustomerCommandResult(
            $result->getId()
        );
    }
}
