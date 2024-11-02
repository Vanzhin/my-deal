<?php
declare(strict_types=1);

namespace App\Shared\Domain\Service\Accounting\Mappers;

use App\Shared\Domain\Service\Accounting\VO\Customer;
use App\Shared\Domain\Service\Accounting\Response\BasicResponse;
use Psr\Http\Message\ResponseInterface;

class ResponseMapper
{
    private function build(ResponseInterface $response)
    {
        return json_decode($response->getBody()->__toString(), true);
    }

    public function buildBasicResponse(ResponseInterface $response): BasicResponse
    {
        $build = $this->build($response);
        return new BasicResponse(
            $response->getStatusCode(),
            $build,
        );
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

    private function buildCustomer(array $response): ?Customer
    {
        $data = current($response['ResourceList']);
        if (!$data) {
            return null;
        }

        return new Customer($data['Id'], $data['Inn']);
    }
}