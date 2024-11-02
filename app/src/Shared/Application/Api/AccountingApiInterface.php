<?php
declare(strict_types=1);


namespace App\Shared\Application\Api;

use Psr\Http\Message\ResponseInterface;

interface AccountingApiInterface
{
    public function getCustomerByTin(string $tin): ResponseInterface;

}