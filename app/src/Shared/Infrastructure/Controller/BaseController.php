<?php
declare(strict_types=1);


namespace App\Shared\Infrastructure\Controller;

use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\RequestHeadersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    protected ?int $kontragentId;

    public function __construct(
        private readonly RequestHeadersService       $headersService,
        private readonly CustomerRepositoryInterface $customerRepository,
        private readonly AccountingServiceInterface  $accountingService,
    )
    {
        $tin = $this->headersService->getTin();
        AssertService::notNull($tin, 'No Tin provided.');
        $this->kontragentId = $this->customerRepository->findOneByTin($tin)?->getKontragentId();
        AssertService::notNull($this->kontragentId, 'No Customer found.');

        //todo если нету в нашей бд, выполнить запрос в мое дело, если и там нет, то кинуть ошибку


    }

}