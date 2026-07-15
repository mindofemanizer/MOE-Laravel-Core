<?php

declare(strict_types=1);

namespace Moe\Core\Base;

use Illuminate\Support\Facades\Log;

abstract class BaseService
{
    /**
     * Log an activity for debugging and audit trail.
     */
    protected function log(string $message, array $context = []): void
    {
        Log::channel('core')->info($message, $context);
    }

    /**
     * Check if a module is installed and registered.
     */
    protected function isModuleInstalled(string $module): bool
    {
        return app()->bound("module.{$module}");
    }

    /**
     * Get a module instance or throw exception if not installed.
     */
    protected function getModule(string $module): mixed
    {
        if (! $this->isModuleInstalled($module)) {
            throw new \Moe\Core\Exceptions\ModuleNotInstalled("Module [{$module}] is not installed.");
        }

        return app("module.{$module}");
    }
}
