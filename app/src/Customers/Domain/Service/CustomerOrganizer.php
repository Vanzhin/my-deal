<?php
declare(strict_types=1);


namespace App\Customers\Domain\Service;



use App\Customers\Domain\Aggregate\Customer\Customer;
use App\Customers\Domain\Factory\CustomerFactory;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\AssertService;

class CustomerOrganizer
{
    public function __construct(
        private readonly CustomerFactory             $customerFactory,
        private readonly AccountingServiceInterface $accountingService
    )
    {
    }

    public function create(string $tin): Customer
    {
        // проверяю, есть ли такой клиент
        $response = $this->accountingService->getCustomerByTin($tin);
        AssertService::true($response->isSuccess(), $response->getMessage());
        //todo  доделать
        if (!$response->isSuccess()) {}
        dd($response);

//        $response = $this->billingService->getAccountBalance($userId);
//        AssertService::greaterThanEq($response->getData(), $sum, 'User has not enough money in the account.');
        return $this->maker->make($userId, $sum);
    }


}