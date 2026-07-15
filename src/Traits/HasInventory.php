<?php

namespace Moe\Core\Traits;

use Moe\Core\Contracts\HasInventory;
use Moe\Core\Exceptions\StockNotAvailable;

trait HasInventory
{
    public function inventory()
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
        $this->inventory()->increment('quantity', $quantity);
    }

    public function decrementStock(int $quantity): void
    {
        if (! $this->isStockAvailable($quantity)) {
            throw new StockNotAvailable("Stok tidak mencukupi. Dibutuhkan: {$quantity}, Tersedia: {$this->getStock()}");
        }

        $this->inventory()->decrement('quantity', $quantity);
    }
}
