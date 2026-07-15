<?php

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Model;

interface HasInventory
{
    public function inventory();
    public function getStock(): int;
    public function isStockAvailable(int $quantity): bool;
    public function incrementStock(int $quantity): void;
    public function decrementStock(int $quantity): void;
}
