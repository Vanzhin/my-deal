<?php
declare(strict_types=1);


namespace App\Shared\Application\Service;

use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFileFilter;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use App\Shared\Domain\Service\Accounting\Response\BasicResponseInterface;
use App\Shared\Domain\Service\Accounting\Response\ResponseFile;

interface AccountingServiceInterface
{
    public function getCustomerByTin(string $tin): BasicResponseInterface;

    public function getCustomerBillList(CustomerBillFilter $filter): BasicResponseInterface;

    public function getCustomerBillFile(CustomerBillFileFilter $filter): ResponseFile;

}