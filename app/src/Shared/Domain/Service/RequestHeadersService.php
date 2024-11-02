<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class RequestHeadersService
{
    private const string CUSTOMER_HEADER = 'X-CUSTOMER';

    private ?string $tin;

    public function __construct(private readonly RequestStack $requestStack)
    {
        $this->getCustomerDataFromRequest();
    }

    public function getTin(): ?string
    {
        return $this->tin;
    }

    private function getCustomerDataFromRequest(): void
    {
        $customerData = $this->requestStack->getCurrentRequest()->headers->get(self::CUSTOMER_HEADER, '');
        $customerData = json_decode($customerData, true);
        $this->tin = $customerData['tin'] ?? null;
    }
}