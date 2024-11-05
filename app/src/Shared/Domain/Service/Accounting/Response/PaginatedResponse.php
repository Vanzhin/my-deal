<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Response;

use App\Shared\Domain\Service\Accounting\PaginationResult;

class PaginatedResponse implements BasicResponseInterface, \JsonSerializable
{
    public function __construct(
        private int              $httpStatus,
        private PaginationResult $data,
        private ?string          $message = null
    )
    {
    }

    public function isSuccess(): bool
    {
        return $this->getHttpStatus() >= 200 && $this->getHttpStatus() < 300;
    }

    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function isEmptySet(): bool
    {
        return $this->data->items === [];
    }

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }
}