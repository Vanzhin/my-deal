<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Controller;

use App\Customers\Application\UseCase\Command\CreateCustomer\CreateCustomerCommand;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\RequestHeadersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/customer', methods: ['POST'])]
class AddCustomerAction extends AbstractController
{
    public function __construct(
        private readonly RequestHeadersService $requestHeadersService,
        private readonly CommandBusInterface   $commandBus,
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $tin = $this->requestHeadersService->getTin();
        AssertService::notNull($tin, 'No Tin provided.');
        $result = $this->commandBus->execute(new CreateCustomerCommand($tin));

        return new JsonResponse($result);
    }

}