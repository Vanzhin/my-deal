<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Response;

class BasicResponse implements \JsonSerializable
{
    public function __construct(
        private int   $httpStatus,
        private mixed $data,
        private ?string $message = null,
    )
    {
    }

    public function isSuccess(): bool
    {
        return $this->getHttpStatus() >= 200 && $this->getHttpStatus() < 300;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function isEmptySet(): bool
    {
        return [] === $this->data;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}