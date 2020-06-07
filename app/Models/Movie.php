<?php

namespace App\Models;

use App\Traits\Hashidable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

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
    use HasSlug;
    use Hashidable;

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

    //=== METHODS ===//
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
