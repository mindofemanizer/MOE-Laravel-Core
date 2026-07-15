<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface HasOrders
{
    /**
     * Get the orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany;

    /**
     * Get the total number of orders.
     *
     * @return int
     */
    public function getTotalOrders(): int;

    /**
     * Get the total amount spent.
     *
     * @return float
     */
    public function getTotalSpent(): float;
}
