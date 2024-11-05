<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\EventHandler;

use App\Customers\Application\UseCase\Command\CreateCustomer\CreateCustomerCommand;
use App\Customers\Application\UseCase\CommandInteractor;
use App\Customers\Domain\Event\CustomerFoundEvent;
use App\Shared\Application\Event\EventHandlerInterface;


class CustomerFoundEventHandler implements EventHandlerInterface
{
    public function __construct(
        private CommandInteractor $commandInteractor
    )
    {
    }

    public function __invoke(CustomerFoundEvent $event): void
    {
        $this->commandInteractor->createCustomer(new CreateCustomerCommand($event->tin));
    }

}