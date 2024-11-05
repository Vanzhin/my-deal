<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\VO;

use JsonSerializable;

readonly class CustomerBill implements JsonSerializable
{
    //"Id" => 578952499
    //      "Number" => "2438"
    //      "DocDate" => "2023-12-31"
    //      "Type" => 1
    //      "Status" => 6
    //      "KontragentId" => 32252155
    //      "SettlementAccount" => array:2 [
    //        "AccountId" => 7558738
    //        "AccountNumber" => "40802810202270001675"
    //      ]
    //      "ProjectId" => 578951368
    //      "StockId" => null
    //      "DeadLine" => "2024-01-14"
    //      "AdditionalInfo" => null
    //      "ContractSubject" => null
    //      "NdsPositionType" => 1
    //      "IsCovered" => true
    //      "Sum" => 64440.0
    //      "PaidSum" => 64440.0
    //      "Comment" => null
    public function __construct(
        private int     $id,
        private string  $number,
        private string  $date,
        private ?bool   $is_covered,
        private ?int    $sum,
        private ?int    $paid_sum,
        private ?string $comment,
    )
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getIsCovered(): ?bool
    {
        return $this->is_covered;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function getPaidSum(): ?int
    {
        return $this->paid_sum;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}