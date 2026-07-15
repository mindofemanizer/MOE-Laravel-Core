<?php

namespace Moe\Core\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    use SoftDeletes;

    /**
     * Get the table name with configurable prefix.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $module = $this->getModuleName();
        $tableName = config("core.tables.{$module}.{$this->table}", $this->table);

        if ($tableName !== $this->table) {
            $this->table = $tableName;
        }
    }

    /**
     * Get the module name for config resolution.
     * Override in child classes if needed.
     */
    protected function getModuleName(): string
    {
        return strtolower(class_basename(static::class));
    }
}
