<?php
declare(strict_types=1);


namespace App\Customers\Domain\Aggregate\Customer;

use App\Shared\Domain\Aggregate\Aggregate;
use App\Shared\Domain\Service\UuidService;

class Customer extends Aggregate
{
    private readonly string $id;


    public function __construct(
        private readonly string $tin,
        private readonly int    $kontragentId,

    )
    {
        $this->id = UuidService::generate();
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

}