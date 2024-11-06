<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Filters;

use App\Shared\Domain\Service\Accounting\Filters\VO\BillFileFormat;

class CustomerBillFileFilter implements \JsonSerializable
{

    public function __construct(
        private int            $billId,
        private bool           $hasStampAndSign = true,
        private BillFileFormat $billFormat = BillFileFormat::PDF,
    )
    {
    }

    public function getBillId(): int
    {
        return $this->billId;
    }

    public function getBillFormat(): BillFileFormat
    {
        return $this->billFormat;
    }

    public function hasStampAndSign(): bool
    {
        return $this->hasStampAndSign;
    }

    public function setHasStampAndSign(bool $hasStampAndSign): void
    {
        $this->hasStampAndSign = $hasStampAndSign;
    }

    public function setBillFormat(BillFileFormat $billFormat): void
    {
        $this->billFormat = $billFormat;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}