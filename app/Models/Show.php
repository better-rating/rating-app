<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Show
 * @package App\Models
 *
 * @table shows
 * @col name string
 * @col release_date date
 */
class Show extends BaseModel
{
    use HasSlug;

    protected $dates = [
        'release_date'
    ];

    //=== RELATIONSHIPS ===//
    public function episodes()
    {
        return $this->hasMany(Episode::class);
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
