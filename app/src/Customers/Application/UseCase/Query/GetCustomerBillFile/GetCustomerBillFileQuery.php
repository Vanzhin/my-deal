<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetCustomerBillFile;

use App\Shared\Application\Query\Query;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFileFilter;

readonly class GetCustomerBillFileQuery extends Query
{
    public function __construct(public CustomerBillFileFilter $filter)
    {
    }
}