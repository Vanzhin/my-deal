<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetPagedCustomerBills;

use App\Shared\Domain\Service\Accounting\Pager;

readonly class GetPagedCustomerBillsQueryResult
{
    public function __construct(public array $list, public Pager $pagination)
    {
    }
}