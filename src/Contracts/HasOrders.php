<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasOrders
{
    public function orders(): HasMany;
    public function getTotalOrders(): int;
    public function getTotalSpent(): float;
}
