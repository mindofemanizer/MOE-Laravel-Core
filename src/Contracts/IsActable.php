<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

interface IsActable
{
    public function isActive(): bool;
    public function activate(): void;
    public function deactivate(): void;
}
