<?php
declare(strict_types=1);


namespace App\Customers\Domain\Aggregate\Customer\Specification;

use App\Customers\Domain\Aggregate\Customer\Customer;
use App\Customers\Domain\Repository\CustomerRepositoryInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;

readonly class UniqueCustomerTinSpecification implements SpecificationInterface
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function satisfy(Customer $customer): void
    {
        $exist = $this->customerRepository->findOneByTin($customer->getTin());
        AssertService::notNull(
            $exist,
            sprintf('Customer with tin %s already exist.', $exist->getTin())
        );
    }

}