<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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
    use HasSlug;

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

    //=== METHODS ===//
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
