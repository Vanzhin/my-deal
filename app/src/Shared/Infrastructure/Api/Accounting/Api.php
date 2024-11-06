<?php
declare(strict_types=1);


namespace App\Shared\Infrastructure\Api\Accounting;

use App\Shared\Application\Api\AccountingApiInterface;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFileFilter;
use App\Shared\Domain\Service\Accounting\Filters\CustomerBillFilter;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

final class Api extends \GuzzleHttp\Client implements AccountingApiInterface
{
    private const string URI_GET_CUSTOMER_LIST = '/kontragents/api/v1/kontragent';
    private const string URI_GET_CUSTOMER_BILL_LIST = '/accounting/api/v1/sales/bill';
    private const string URI_GET_CUSTOMER_BILL_FILE = '/accounting/api/v1/sales/bill/{{BILL_ID}}/';


    public function getCustomerByTin(string $tin): ResponseInterface
    {
        return $this->get(self::URI_GET_CUSTOMER_LIST,
            [
                RequestOptions::QUERY => [
                    'inn' => $tin,
                ],
            ]
        );
    }

    public function getCustomerBillList(CustomerBillFilter $filter): ResponseInterface
    {
        return $this->get(self::URI_GET_CUSTOMER_BILL_LIST,
            [
                RequestOptions::QUERY => $filter->jsonSerialize(),
            ]
        );
    }

    public function getCustomerFile(CustomerBillFileFilter $filter): ResponseInterface
    {
        $uri = str_replace('{{BILL_ID}}', (string)$filter->getBillId(), self::URI_GET_CUSTOMER_BILL_FILE);
        $format = $filter->getBillFormat()->value;
        $uri .= $format;

        return $this->get($uri,
            [
                RequestOptions::QUERY => [
                    'addStampAndSign' => $filter->hasStampAndSign() ? 'true' : 'false',
                ]
            ]
        );
    }
}