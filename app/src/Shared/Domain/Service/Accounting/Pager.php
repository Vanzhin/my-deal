<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting;

readonly class Pager
{
    public ?int $total_pages;

    public function __construct(
        public int  $page,
        public int  $limit,
        public ?int $total_items = null,
    )
    {
        $this->setTotalPages();
    }

    public static function fromPage(int $page, int $perPage): self
    {
        return new self($page, $perPage);
    }

    private function setTotalPages(): void
    {
        if (!$this->total_items) {
            $this->total_pages = null;
        } else {
            $this->total_pages = (int)ceil($this->total_items / $this->limit);
        }
    }

    public function getOffset(): int
    {
        if (1 === $this->page) {
            return 0;
        }

        return $this->page * $this->limit - $this->limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}