<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting;

use App\Shared\Application\Api\AccountingApiInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use App\Shared\Domain\Service\Accounting\Mappers\ResponseMapper;
use App\Shared\Domain\Service\Accounting\Response\BasicResponseInterface;

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


    public function getCustomerByTin(string $tin): BasicResponseInterface
    {
        $result = $this->api->getCustomerByTin($tin);
        return $this->mapper->buildCustomerResponse($result);
    }

    public function getCustomerBillList(CustomerBillFilter $filter): BasicResponseInterface
    {
        $result = $this->api->getCustomerBillList($filter);
        if ($result->getStatusCode() !== 200) {
            throw new \Exception($this->mapper->getMessageFromResponse($result), $result->getStatusCode());
        }

        return $this->mapper->buildCustomerListResponse($result);
    }
}