<?php
declare(strict_types=1);


namespace App\Customers\Domain\Aggregate\Customer;

use App\Customers\Domain\Aggregate\Customer\Specification\CustomerSpecification;
use App\Shared\Domain\Aggregate\Aggregate;
use App\Shared\Domain\Service\UuidService;

class Customer extends Aggregate
{
    private readonly string $id;
    private CustomerSpecification $specification;
    private string $tin;
    private int $kontragentId;


    public function __construct(
        string                $tin,
        int                   $kontragentId,
        CustomerSpecification $specification,

    )
    {
        $this->id = UuidService::generate();
        $this->specification = $specification;
        $this->setTin($tin);
        $this->setKontragentId($kontragentId);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTin(): string
    {
        return $this->tin;
    }

    public function getKontragentId(): int
    {
        return $this->kontragentId;
    }

    private function setTin(string $tin): void
    {
        $this->tin = $tin;
        $this->specification->uniqueCustomerTinSpecification->satisfy($this);
    }

    private function setKontragentId(int $kontragentId): void
    {
        $this->kontragentId = $kontragentId;
        $this->specification->uniqueCustomerKontragentId->satisfy($this);
    }
}