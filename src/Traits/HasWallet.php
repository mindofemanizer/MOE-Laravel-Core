<?php

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        return DB::transaction(function () use ($amount, $type, $description) {
            $wallet = $this->wallet()->firstOrCreate([]);

            $wallet->increment('balance', $amount);
            $wallet = $wallet->fresh();

            return $wallet->transactions()->create([
                'type' => $type,
                'amount' => $amount,
                'description' => $description,
                'balance_before' => $wallet->balance - $amount,
                'balance_after' => $wallet->balance,
            ]);
        });
    }

    public function debit(float $amount, string $type, ?string $description = null): Model
    {
        return DB::transaction(function () use ($amount, $type, $description) {
            $wallet = $this->wallet()->firstOrCreate([]);

            if ((float) $wallet->balance < $amount) {
                throw new InsufficientBalance("Saldo tidak mencukupi. Dibutuhkan: {$amount}, Tersedia: {$wallet->balance}");
            }

            $wallet->decrement('balance', $amount);
            $wallet = $wallet->fresh();

            return $wallet->transactions()->create([
                'type' => $type,
                'amount' => -$amount,
                'description' => $description,
                'balance_before' => $wallet->balance + $amount,
                'balance_after' => $wallet->balance,
            ]);
        });
    }

    public function hasSufficientBalance(float $amount): bool
    {
        return $this->getBalance() >= $amount;
    }
}
