<?php

namespace App\Models;

/**
 * Class Profile
 * @package App\Models
 *
 * @table profiles
 * @col user_id integer
 * @col name string
 * @col media_type string
 */
class Profile extends BaseModel
{
    //=== RELATIONSHIPS ===//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
