<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

interface IsSellable
{
    /**
     * Check if the product is available for sale.
     *
     * @return bool
     */
    public function isAvailable(): bool;

    /**
     * Get the current stock.
     *
     * @return int
     */
    public function getStock(): int;

    /**
     * Get the price.
     *
     * @return float
     */
    public function getPrice(): float;

    /**
     * Get the minimum order quantity.
     *
     * @return int
     */
    public function getMinimumOrder(): int;
}
