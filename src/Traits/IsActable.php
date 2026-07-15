<?php

namespace Moe\Core\Traits;

use Moe\Core\Contracts\IsActable;

trait IsActable
{
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function activate(): void
    {
        $this->update(['is_active' => true]);
    }

    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }
}
