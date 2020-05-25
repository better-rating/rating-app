<?php

namespace App\Models;

/**
 * Class RatingPartial
 * @package App\Models
 *
 * @table rating_partials
 * @col user_id integer
 * @col name string
 * @col description string
 * @col possible_score integer
 * @col labels string
 */
class RatingPartial extends BaseModel
{
    //=== RELATIONSHIPS ===//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
