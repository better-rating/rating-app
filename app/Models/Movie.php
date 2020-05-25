<?php

namespace App\Models;

/**
 * Class Movie
 * @package App\Models
 *
 * @table movies
 * @col name string
 * @col release_date date
 */
class Movie extends BaseModel
{
    protected $dates = [
        'release_date'
    ];

    //=== RELATIONSHIPS ===//
    public function rating()
    {
        return $this->morphOne(Rating::class, 'media');
    }

    public function links()
    {
        return $this->morphMany(Link::class, 'media');
    }

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

}
