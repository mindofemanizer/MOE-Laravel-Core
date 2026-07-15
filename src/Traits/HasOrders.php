<?php

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Moe\Core\Contracts\HasOrders;

trait HasOrders
{
    public function orders(): HasMany
    {
        return $this->hasMany(config('core.models.order', 'App\\Models\\Order'));
    }

    public function getTotalOrders(): int
    {
        return $this->orders()->count();
    }

    public function getTotalSpent(): float
    {
        return (float) $this->orders()
            ->where('payment_status', 'paid')
            ->sum('total');
    }
}
