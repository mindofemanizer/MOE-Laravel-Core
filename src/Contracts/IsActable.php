<?php

declare(strict_types=1);

namespace Moe\Core\Contracts;

interface IsActable
{
    /**
     * Check if the entity is active.
     *
     * @return bool
     */
    public function isActive(): bool;

    /**
     * Activate the entity.
     *
     * @return void
     */
    public function activate(): void;

    /**
     * Deactivate the entity.
     *
     * @return void
     */
    public function deactivate(): void;
}
