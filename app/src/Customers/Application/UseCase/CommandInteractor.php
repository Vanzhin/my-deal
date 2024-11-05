<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase;

use App\Customers\Application\UseCase\Command\CreateCustomer\CreateCustomerCommand;
use App\Shared\Application\Command\CommandBusInterface;

readonly class CommandInteractor
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    public function createCustomer(CreateCustomerCommand $command): void
    {
        $this->commandBus->execute($command);
    }
}