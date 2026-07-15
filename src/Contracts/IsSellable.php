<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

interface IsSellable
{
    public function isAvailable(): bool;
    public function getStock(): int;
    public function getPrice(): float;
    public function getMinimumOrder(): int;
}
