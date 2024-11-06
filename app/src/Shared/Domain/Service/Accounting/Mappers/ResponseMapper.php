<?php
declare(strict_types=1);

namespace App\Shared\Domain\Service\Accounting\Mappers;

use App\Shared\Domain\Service\Accounting\PaginationResult;
use App\Shared\Domain\Service\Accounting\Response\PaginatedResponse;
use App\Shared\Domain\Service\Accounting\Response\ResponseFile;
use App\Shared\Domain\Service\Accounting\VO\Customer;
use App\Shared\Domain\Service\Accounting\Response\BasicResponse;
use App\Shared\Domain\Service\Accounting\VO\CustomerBill;
use App\Shared\Domain\Service\UuidService;
use Psr\Http\Message\ResponseInterface;

class ResponseMapper
{
    public function buildBasicResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        return new BasicResponse(
            $response->getStatusCode(),
            $build,
        );
    }

    public function getMessageFromResponse(ResponseInterface $response): string
    {
        $build = $this->build($response);
        return $build['Message'] ?? 'Unknown error.';
    }


    public function buildCustomerResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        if ($response->getStatusCode() === 200) {
            $data = $this->buildCustomer($build) ?? [];
        } else {
            $message = $build['Message'] ?? null;
            $data = null;
        }

        return new BasicResponse(
            $response->getStatusCode(),
            $data,
            $message ?? null,
        );
    }

    public function buildCustomerListResponse(ResponseInterface $response): PaginatedResponse
    {
        $build = $this->build($response);
        $bills = [];
        foreach ($build['ResourceList'] ?? [] as $customer) {
            $bills[] = $this->buildCustomerBill($customer);
        }
        $data = new PaginationResult(
            $bills,
            $build['TotalCount'] ?? null
        );

        return new PaginatedResponse(
            $response->getStatusCode(),
            $data,
            null,
        );
    }

    public function buildCustomerBillFileResponse(ResponseInterface $response): ResponseFile
    {
        preg_match('/^.*filename[^;=\n]*=utf-8\'\'(([\'"]).*?\2|[^;\n]*)[\n;]?$/', $response->getHeaderLine('content-disposition'), $fName);
        $fileName = UuidService::generate() . '.' . (new \SplFileInfo($fName[1]))->getExtension();
        return new ResponseFile($response->getBody(), $fileName, $response->getHeaderLine('content-type'));
    }

    private function build(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->__toString(), true);
    }

    private function buildCustomer(array $response): ?Customer
    {
        $data = current($response['ResourceList']);
        if (!$data) {
            return null;
        }

        return new Customer($data['Id'], $data['Inn']);
    }

    private function buildCustomerBill(array $data): CustomerBill
    {
        return new CustomerBill(
            (int)$data['Id'],
            $data['Number'],
            $data['DocDate'],
            $data['IsCovered'] ?? null,
            $data['Sum'] ?? null,
            $data['PaidSum'] ?? null,
            $data['Comment'] ?? null,
        );
    }
}