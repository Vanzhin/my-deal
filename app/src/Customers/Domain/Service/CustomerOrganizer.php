<?php
declare(strict_types=1);


namespace App\Customers\Domain\Service;


use App\Customers\Domain\Aggregate\Customer\Customer;
use App\Customers\Domain\Factory\CustomerFactory;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Shared\Application\Service\AccountingServiceInterface;
use App\Shared\Domain\Service\AssertService;

readonly class CustomerOrganizer
{
    public function __construct(
        private CustomerFactory             $customerFactory,
        private AccountingServiceInterface  $accountingService,
        private CustomerRepositoryInterface $customerRepository,
    )
    {
    }

    public function create(string $tin): Customer
    {
        // проверяю, есть ли такой клиент
        $response = $this->accountingService->getCustomerByTin($tin);
        AssertService::true($response->isSuccess(), $response->getMessage());
        AssertService::false($response->isEmptySet(), 'No linked customer found.');
        $customer = $this->customerFactory->create($tin, $response->getData()->id);
        $this->customerRepository->add($customer);

        return $customer;
    }
}