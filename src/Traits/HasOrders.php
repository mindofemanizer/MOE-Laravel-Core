<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Relations\HasMany;

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
