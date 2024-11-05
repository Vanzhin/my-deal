<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Mapper;

use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class CustomerMapper
{
    public function buildCustomerBillFilterFromRequest(Request $request, int $kontragentId): CustomerBillFilter
    {
        $filter = new CustomerBillFilter($kontragentId);
        if (isset($request->get('filters')['from'])) {
            $filter->setAfterDate(new \DateTimeImmutable($request->get('filters')['from']));
        }
        if (isset($request->get('filters')['to'])) {
            $filter->setBeforeDate(new \DateTimeImmutable($request->get('filters')['to']));
        }
        if ($request->get('page')) {
            $filter->setPageNo((int)$request->get('page'));
        }
        if ($request->get('limit')) {
            $filter->setPageSize((int)$request->get('limit'));
        }

        return $filter;
    }

    public function getValidationCollectionCustomerBillList(): Assert\Collection
    {
        return new Assert\Collection([
            'filters' => [
                new Assert\NotNull(),
                new Assert\Collection([
                    'from' => new Assert\Optional([
                        new Assert\NotBlank(),
                        new Assert\DateTime(DATE_ATOM),
                    ]),
                    'to' => new Assert\Optional([
                        new Assert\NotBlank(),
                        new Assert\DateTime(DATE_ATOM),
                    ]),
                ])],
            'page' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('numeric'),
                new Assert\Range(min: 1)
            ]),
            'limit' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('numeric'),
                new Assert\Range(min: 1, max: 500)
            ]),
        ]);
    }
}