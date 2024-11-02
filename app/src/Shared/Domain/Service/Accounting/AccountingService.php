<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting;

use App\Shared\Application\Api\AccountingApiInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\Accounting\Mappers\ResponseMapper;
use App\Shared\Domain\Service\Accounting\Response\BasicResponse;

class AccountingService implements AccountingServiceInterface
{
    public function __construct(private readonly AccountingApiInterface $api, private readonly ResponseMapper $mapper)
    {
    }


//    #[\Override] public function withdrawFromAccount(TransactionVO $transactionVO, string $userId): BasicResponse
//    {
//        $request = new TransactionVO(
//            -abs($transactionVO->getSum()),
//            $transactionVO->getDocumentId(),
//            $transactionVO->getType()
//        );
//        $response = $this->api->addAccountTransaction($request, $userId);
//
//        return $this->mapper->buildBasicResponse($response);
//    }


    public function getCustomerByTin(string $tin): BasicResponse
    {
        $result = $this->api->getCustomerByTin($tin);
        return $this->mapper->buildCustomerResponse($result);
    }
}