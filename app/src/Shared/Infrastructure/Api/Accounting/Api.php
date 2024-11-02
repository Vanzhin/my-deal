<?php
declare(strict_types=1);


namespace App\Shared\Infrastructure\Api\Accounting;

use App\Shared\Application\Api\AccountingApiInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;

final class Api extends \GuzzleHttp\Client implements AccountingApiInterface
{
    private const string URI_GET_CUSTOMER_LIST = '/kontragents/api/v1/kontragent';


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
}