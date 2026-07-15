<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

trait IsSellable
{
    public function isAvailable(): bool
    {
        return (bool) $this->is_active && $this->getStock() > 0;
    }

    public function getStock(): int
    {
        return $this->inventory?->quantity ?? 0;
    }

    public function getPrice(): float
    {
        return (float) $this->retail_price;
    }

    public function getMinimumOrder(): int
    {
        return $this->minimum_order ?? 1;
    }
}
