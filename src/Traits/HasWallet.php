<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Moe\Core\Exceptions\InsufficientBalance;

trait HasWallet
{
    /**
     * Get the wallet relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(config('core.models.wallet', 'App\\Models\\Wallet'));
    }

    /**
     * Get the current balance.
     *
     * @return float
     */
    public function getBalance(): float
    {
        return (float) ($this->wallet?->balance ?? 0);
    }

    /**
     * Credit the wallet.
     *
     * @param float $amount
     * @param string $type
     * @param string|null $description
     * @return \Illuminate\Database\Eloquent\Model
     */
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

    /**
     * Debit the wallet.
     *
     * @param float $amount
     * @param string $type
     * @param string|null $description
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Moe\Core\Exceptions\InsufficientBalance
     */
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

    /**
     * Check if the wallet has sufficient balance.
     *
     * @param float $amount
     * @return bool
     */
    public function hasSufficientBalance(float $amount): bool
    {
        return $this->getBalance() >= $amount;
    }
}
