<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

interface HasWallet
{
    public function wallet(): HasOne;
    public function getBalance(): float;
    public function credit(float $amount, string $type, ?string $description = null): Model;
    public function debit(float $amount, string $type, ?string $description = null): Model;
    public function hasSufficientBalance(float $amount): bool;
}
