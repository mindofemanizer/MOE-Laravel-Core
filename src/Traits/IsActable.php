<?php

declare(strict_types=1);

namespace Moe\Core\Traits;

trait IsActable
{
    /**
     * Check if the entity is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    /**
     * Activate the entity.
     *
     * @return void
     */
    public function activate(): void
    {
        $this->update(['is_active' => true]);
    }

    /**
     * Deactivate the entity.
     *
     * @return void
     */
    public function deactivate(): void
    {
        $this->update(['is_active' => false]);
    }
}
