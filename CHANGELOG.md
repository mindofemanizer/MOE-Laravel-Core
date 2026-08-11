# Changelog

All notable changes to this package will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2026-08-11

### Added
- Contracts: `HasWallet`, `IsSellable`, `HasOrders`, `HasInventory`, `IsActable`
- Traits implementing each contract: `HasWallet`, `IsSellable`, `HasOrders`, `HasInventory`, `IsActable`
- `BaseModel` with configurable table names
- `BaseService` with logging and module detection
- Exceptions: `InsufficientBalance`, `StockNotAvailable`, `ModuleNotInstalled`
- `CoreServiceProvider` with config and migration publishing
- Configurable model and table overrides via `config/core.php`
