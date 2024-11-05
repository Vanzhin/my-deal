<?php
declare(strict_types=1);


namespace App\Shared\Application\Api;

use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use Psr\Http\Message\ResponseInterface;

interface AccountingApiInterface
{
    public function getCustomerByTin(string $tin): ResponseInterface;

    public function getCustomerBillList(CustomerBillFilter $filter): ResponseInterface;

}