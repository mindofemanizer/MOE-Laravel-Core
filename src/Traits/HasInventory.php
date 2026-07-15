<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Moe\Core\Exceptions\StockNotAvailable;

trait HasInventory
{
    /**
     * Get the inventory relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory(): HasOne
    {
        return $this->hasOne(config('core.models.inventory', 'App\\Models\\Inventory'));
    }

    /**
     * Get the current stock quantity.
     *
     * @return int
     */
    public function getStock(): int
    {
        return $this->inventory?->quantity ?? 0;
    }

    /**
     * Check if stock is available for the given quantity.
     *
     * @param int $quantity
     * @return bool
     */
    public function isStockAvailable(int $quantity): bool
    {
        return $this->getStock() >= $quantity;
    }

    /**
     * Increment stock by the given quantity.
     *
     * @param int $quantity
     * @return void
     */
    public function incrementStock(int $quantity): void
    {
        $inventory = $this->inventory()->firstOrCreate([]);
        $inventory->increment('quantity', $quantity);
    }

    /**
     * Decrement stock by the given quantity.
     *
     * @param int $quantity
     * @return void
     *
     * @throws \Moe\Core\Exceptions\StockNotAvailable
     */
    public function decrementStock(int $quantity): void
    {
        $inventory = $this->inventory()->firstOrCreate([]);

        if ((int) $inventory->quantity < $quantity) {
            throw new StockNotAvailable("Stok tidak mencukupi. Dibutuhkan: {$quantity}, Tersedia: {$inventory->quantity}");
        }

        $inventory->decrement('quantity', $quantity);
    }
}
