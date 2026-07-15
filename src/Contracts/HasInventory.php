<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasInventory
{
    /**
     * Get the inventory relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inventory(): HasOne;

    /**
     * Get the current stock quantity.
     *
     * @return int
     */
    public function getStock(): int;

    /**
     * Check if stock is available for the given quantity.
     *
     * @param int $quantity
     * @return bool
     */
    public function isStockAvailable(int $quantity): bool;

    /**
     * Increment stock by the given quantity.
     *
     * @param int $quantity
     * @return void
     */
    public function incrementStock(int $quantity): void;

    /**
     * Decrement stock by the given quantity.
     *
     * @param int $quantity
     * @return void
     */
    public function decrementStock(int $quantity): void;
}
