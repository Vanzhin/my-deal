<?php
declare(strict_types=1);


namespace App\Shared\Application\Service;

use App\Shared\Domain\Service\Accounting\Response\BasicResponse;

interface AccountingServiceInterface
{
    public function getCustomerByTin(string $tin): BasicResponse;

}