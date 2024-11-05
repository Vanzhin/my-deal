<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Filters;

class CustomerBillFilter implements \JsonSerializable
{
    private \DateTimeImmutable|null $afterDate = null;
    private \DateTimeImmutable|null $beforeDate = null;
    private int $pageNo = 1;
    private int $pageSize = 10;

    public function __construct(
        private int $kontragentId,
    )
    {
    }

    public function getKontragentId(): int
    {
        return $this->kontragentId;
    }

    public function getAfterDate(): ?\DateTimeImmutable
    {
        return $this->afterDate;
    }

    public function getBeforeDate(): ?\DateTimeImmutable
    {
        return $this->beforeDate;
    }

    public function getPageNo(): int
    {
        return $this->pageNo;
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }

    public function setAfterDate(?\DateTimeImmutable $afterDate): void
    {
        $this->afterDate = $afterDate;
    }

    public function setBeforeDate(?\DateTimeImmutable $beforeDate): void
    {
        $this->beforeDate = $beforeDate;
    }

    public function setPageNo(int $pageNo): void
    {
        $this->pageNo = $pageNo;
    }

    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    public function jsonSerialize(): array
    {

        return array_merge(
            get_object_vars($this),
            [
                'afterDate' => $this->afterDate->format("Y-m-d\TH:i:s"),
                'beforeDate' => $this->beforeDate->format("Y-m-d\TH:i:s"),
            ]
        );
    }
}