<?php
declare(strict_types=1);


namespace App\Customers\Domain\Event;

use App\Shared\Domain\Event\EventInterface;

class CustomerFoundEvent implements EventInterface
{
    public function __construct(public string $tin)
    {
    }
}