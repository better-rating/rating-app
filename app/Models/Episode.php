<?php

namespace App\Models;

/**
 * Class Episode
 * @package App\Models
 *
 * @table episodes
 * @col title string
 * @col show_id integer
 * @col season_number integer
 * @col episode_number integer
 */
class Episode extends BaseModel
{
    protected $dates = [
        'release_date'
    ];

    //=== RELATIONSHIPS ===//
    public function show()
    {
        return $this->belongsTo(Show::class);
    }

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
