<?php

namespace App\Models;

use App\Traits\Hashidable;

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
    use Hashidable;

    //=== RELATIONSHIPS ===//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
