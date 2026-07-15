<?php

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Moe\Core\Contracts\HasWallet as HasWalletContract;
use Moe\Core\Exceptions\InsufficientBalance;

trait HasWallet
{
    public function wallet()
    {
        return $this->hasOne(config('core.models.wallet', 'App\\Models\\Wallet'));
    }

    public function getBalance(): float
    {
        return (float) ($this->wallet?->balance ?? 0);
    }

    public function credit(float $amount, string $type, ?string $description = null): Model
    {
        $wallet = $this->wallet()->firstOrCreate([]);

        $wallet->increment('balance', $amount);

        return $wallet->transactions()->create([
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
            'balance_before' => $wallet->fresh()->balance - $amount,
            'balance_after' => $wallet->fresh()->balance,
        ]);
    }

    public function debit(float $amount, string $type, ?string $description = null): Model
    {
        if (! $this->hasSufficientBalance($amount)) {
            throw new InsufficientBalance("Saldo tidak mencukupi. Dibutuhkan: {$amount}, Tersedia: {$this->getBalance()}");
        }

        $wallet = $this->wallet;
        $wallet->decrement('balance', $amount);

        return $wallet->transactions()->create([
            'type' => $type,
            'amount' => -$amount,
            'description' => $description,
            'balance_before' => $wallet->fresh()->balance + $amount,
            'balance_after' => $wallet->fresh()->balance,
        ]);
    }

    public function hasSufficientBalance(float $amount): bool
    {
        return $this->getBalance() >= $amount;
    }
}
