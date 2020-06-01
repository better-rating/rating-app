<?php

namespace App\Models;

use App\Traits\Hashidable;

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
    use Hashidable;

    protected $casts = [
        'labels' => 'array'
    ];

    //=== RELATIONSHIPS ===//
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    //=== ATTRIBUTES ===//
    public function getSimpleLabelsAttribute()
    {
        $result = '';
        foreach ($this->labels as $label) {
            $result .= "{$label}/";
        }
        return trim($result, '/');
    }


    //=== SCOPES ===//

}
