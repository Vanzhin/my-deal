<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetPagedCustomerBills;

use App\Shared\Application\Query\Query;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;

readonly class GetPagedCustomerBillsQuery extends Query
{
    public function __construct(public CustomerBillFilter $filter)
    {
    }
}