<?php

namespace App\Models;

/**
 * Class Module
 * @package App\Models
 *
 * @table
 * @col
 */
class Module extends BaseModel
{
    //protected $table = '';
    //protected $casts = [];

    //=== RELATIONSHIPS ===//
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
