<?php
declare(strict_types=1);


namespace App\Customers\Domain\Aggregate\Customer\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

readonly class CustomerSpecification implements SpecificationInterface
{
    public function __construct(
        public UniqueCustomerKontragentIdSpecification $uniqueCustomerKontragentId,
        public UniqueCustomerTinSpecification          $uniqueCustomerTinSpecification
    )
    {
    }

}