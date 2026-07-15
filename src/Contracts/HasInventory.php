<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasInventory
{
    public function inventory(): HasOne;
    public function getStock(): int;
    public function isStockAvailable(int $quantity): bool;
    public function incrementStock(int $quantity): void;
    public function decrementStock(int $quantity): void;
}
