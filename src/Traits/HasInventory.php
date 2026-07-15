<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Moe\Core\Exceptions\StockNotAvailable;

trait HasInventory
{
    public function inventory(): HasOne
    {
        return $this->hasOne(config('core.models.inventory', 'App\\Models\\Inventory'));
    }

    public function getStock(): int
    {
        return $this->inventory?->quantity ?? 0;
    }

    public function isStockAvailable(int $quantity): bool
    {
        return $this->getStock() >= $quantity;
    }

    public function incrementStock(int $quantity): void
    {
        $inventory = $this->inventory()->firstOrCreate([]);
        $inventory->increment('quantity', $quantity);
    }

    public function decrementStock(int $quantity): void
    {
        $inventory = $this->inventory()->firstOrCreate([]);

        if ((int) $inventory->quantity < $quantity) {
            throw new StockNotAvailable("Stok tidak mencukupi. Dibutuhkan: {$quantity}, Tersedia: {$inventory->quantity}");
        }

        $inventory->decrement('quantity', $quantity);
    }
}
