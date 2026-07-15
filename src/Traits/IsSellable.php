<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

trait IsSellable
{
    /**
     * Check if the product is available for sale.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return (bool) $this->is_active && $this->getStock() > 0;
    }

    /**
     * Get the current stock.
     *
     * @return int
     */
    public function getStock(): int
    {
        return $this->inventory?->quantity ?? 0;
    }

    /**
     * Get the price.
     *
     * @return float
     */
    public function getPrice(): float
    {
        return (float) $this->retail_price;
    }

    /**
     * Get the minimum order quantity.
     *
     * @return int
     */
    public function getMinimumOrder(): int
    {
        return $this->minimum_order ?? 1;
    }
}
