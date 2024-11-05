<?php
declare(strict_types=1);


namespace App\Shared\Application\Service;

use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use App\Shared\Domain\Service\Accounting\Response\BasicResponseInterface;

interface AccountingServiceInterface
{
    public function getCustomerByTin(string $tin): BasicResponseInterface;

    public function getCustomerBillList(CustomerBillFilter $filter): BasicResponseInterface;


}