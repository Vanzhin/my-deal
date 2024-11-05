<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetPagedCustomerBills;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\Accounting\Pager;

readonly class GetPagedCustomerBillsQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private AccountingServiceInterface $accountingService
    )
    {
    }

    public function __invoke(GetPagedCustomerBillsQuery $query): GetPagedCustomerBillsQueryResult
    {
        $result = $this->accountingService->getCustomerBillList($query->filter);
        $pagination = new Pager(
            $query->filter->getPageNo(),
            $query->filter->getPageSize(),
            $result->getData()->total,
        );

        return new GetPagedCustomerBillsQueryResult($result->getData()->items, $pagination);
    }
}