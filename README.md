# MOE-Laravel-Core

Core package for MOE ecosystem — Base contracts, traits, and classes for Laravel.

## Installation

```bash
composer require moe/laravel-core
php artisan vendor:publish --provider="Moe\Core\CoreServiceProvider" --tag="core-config"
```

## What's Included

### Contracts

| Contract | Description |
|----------|-------------|
| `HasWallet` | Model that has a wallet (balance, credit, debit) |
| `IsSellable` | Model that can be sold (stock, price, availability) |
| `HasOrders` | Model that has orders (order history, total spent) |
| `HasInventory` | Model that has inventory (stock management) |
| `IsActable` | Model that can be activated/deactivated |

### Traits

| Trait | Implements |
|-------|-----------|
| `HasWallet` | `HasWallet` contract |
| `IsSellable` | `IsSellable` contract |
| `HasOrders` | `HasOrders` contract |
| `HasInventory` | `HasInventory` contract |
| `IsActable` | `IsActable` contract |

### Base Classes

| Class | Description |
|-------|-------------|
| `BaseModel` | Model with configurable table names |
| `BaseService` | Service with logging and module detection |

### Exceptions

| Exception | Description |
|-----------|-------------|
| `InsufficientBalance` | Thrown when wallet balance is too low |
| `StockNotAvailable` | Thrown when stock is insufficient |
| `ModuleNotInstalled` | Thrown when required module is missing |

## Usage

### Using Contracts (Recommended)

```php
use Moe\Core\Contracts\HasWallet;

class OrderService
{
    public function processPayment(HasWallet $user, float $amount)
    {
        if ($user->hasSufficientBalance($amount)) {
            $user->debit($amount, 'payment', 'Order #123');
        }
    }
}
```

### Using Traits

```php
use Moe\Core\Traits\HasWallet;
use Moe\Core\Contracts\HasWallet as HasWalletContract;

class User extends Authenticatable implements HasWalletContract
{
    use HasWallet;
}
```

### Config Override

```php
// config/core.php
return [
    'models' => [
        'wallet' => App\Models\CustomWallet::class,
    ],
    'tables' => [
        'wallets' => 'custom_wallets',
    ],
];
```

## Requirements

- PHP ^8.2
- Laravel ^13.0

## License

MIT
