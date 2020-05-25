<?php

namespace App\Models;

/**
 * Class Review
 * @package App\Models
 *
 * @table reviews
 * @col rating_id integer
 * @col rating_partial_id integer
 * @col score integer
 * @col possible_score integer
 * @col note string
 */
class Review extends BaseModel
{
    //=== RELATIONSHIPS ===//
    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function rating_partial()
    {
        return $this->belongsTo(RatingPartial::class);
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
