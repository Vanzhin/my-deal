<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Controller;

use App\Customers\Domain\Event\CustomerFoundEvent;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Shared\Application\Event\EventBusInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\RequestHeadersService;
use App\Shared\Infrastructure\Exception\AppException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected ?int $kontragentId;

    public function __construct(
        private readonly RequestHeadersService       $headersService,
        private readonly CustomerRepositoryInterface $customerRepository,
        private readonly AccountingServiceInterface  $accountingService,
        private readonly EventBusInterface           $eventBus,
    )
    {
        $tin = $this->headersService->getTin();
        if (!$tin) {
            throw new AppException('No Tin provided.', 422);
        }
        $this->kontragentId = $this->customerRepository->findOneByTin($tin)?->getKontragentId();
        if ($this->kontragentId) {
            return;
        }
        $result = $this->accountingService->getCustomerByTin($tin);
        if ($result->isEmptySet()) {
            throw new AppException('No customer found.', 422);
        }
        $this->kontragentId = $result->getData()?->id;
        $this->eventBus->execute(new CustomerFoundEvent($tin));
    }

}