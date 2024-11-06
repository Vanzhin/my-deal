<?php
declare(strict_types=1);


namespace App\Customers\Infrastructure\Mapper;

use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFileFilter;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use App\Shared\Domain\Service\Accounting\Filters\VO\BillFileFormat;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class CustomerMapper
{
    public function buildCustomerBillFileFilterFromRequest(Request $request): CustomerBillFileFilter
    {
        $filter = new CustomerBillFileFilter($request->getPayload()->get('bill_id'));
        if ($addStamp = $request->getPayload()->get('has_stamp_and_sign')) {
            $filter->setHasStampAndSign($addStamp);
        }
        if ($format = $request->getPayload()->get('file_format')) {
            $filter->setBillFormat(BillFileFormat::from($format));
        }

        return $filter;
    }

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

    public function getValidationCollectionCustomerBillFile(): Assert\Collection
    {
        return new Assert\Collection([
            'bill_id' => [
                new Assert\NotBlank(),
                new Assert\Type('numeric')
            ],
            'has_stamp_and_sign' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Type('boolean')
            ]),

            'file_format' => new Assert\Optional([
                new Assert\NotBlank(),
                new Assert\Choice(BillFileFormat::getAllValues(),
                    message: sprintf('Invalid choice. Supported: %s.', implode(', ', BillFileFormat::getAllValues())))
            ]),
        ]);
    }

}