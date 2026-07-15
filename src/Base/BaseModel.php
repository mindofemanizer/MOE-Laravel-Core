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

        $overridden = config("core.tables.{$this->table}");

        if ($overridden) {
            $this->table = $overridden;
        }
    }
}
