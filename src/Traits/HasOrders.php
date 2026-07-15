<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasOrders
{
    /**
     * Get the orders relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(config('core.models.order', 'App\\Models\\Order'));
    }

    /**
     * Get the total number of orders.
     *
     * @return int
     */
    public function getTotalOrders(): int
    {
        return $this->orders()->count();
    }

    /**
     * Get the total amount spent.
     *
     * @return float
     */
    public function getTotalSpent(): float
    {
        return (float) $this->orders()
            ->where('payment_status', 'paid')
            ->sum('total');
    }
}
