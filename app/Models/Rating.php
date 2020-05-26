<?php

namespace App\Models;

use App\Traits\Hashidable;

/**
 * Class Rating
 * @package App\Models
 *
 * @table ratings
 * @col user_id integer
 * @col media_id integer
 * @col media_type string
 * @col score integer
 * @col possible_score integer
 * @col score_as_percent integer
 */
class Rating extends BaseModel
{
    use Hashidable;

    //=== RELATIONSHIPS ===//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->morphTo();
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
