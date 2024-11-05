<?php
declare(strict_types=1);


namespace App\Shared\Domain\Service\Accounting\Response;

interface BasicResponseInterface
{
    public function isSuccess(): bool;

    public function getHttpStatus(): int;

    public function getData(): mixed;

    public function getMessage(): ?string;

    public function isEmptySet(): bool;

}