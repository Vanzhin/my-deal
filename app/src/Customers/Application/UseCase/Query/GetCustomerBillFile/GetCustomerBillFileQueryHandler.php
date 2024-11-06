<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetCustomerBillFile;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Application\Service\AccountingServiceInterface;

readonly class GetCustomerBillFileQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private AccountingServiceInterface $accountingService
    )
    {
    }

    public function __invoke(GetCustomerBillFileQuery $query): GetCustomerBillFileQueryResult
    {
        $result = $this->accountingService->getCustomerBillFile($query->filter);

        return new GetCustomerBillFileQueryResult($result);
    }
}