<?php
declare(strict_types=1);


namespace App\Customers\Application\UseCase\Query\GetCustomerBillFile;

use App\Shared\Domain\Service\Accounting\Response\ResponseFile;

readonly class GetCustomerBillFileQueryResult
{
    public function __construct(public ResponseFile $responseFile)
    {
    }
}