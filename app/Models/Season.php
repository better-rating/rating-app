<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

/**
 * Class Season
 * @package App\Models
 *
 * @table
 * @col
 */
class Season extends BaseModel
{
    use HasSlug;

    //protected $table = '';
    //protected $casts = [];

    //=== RELATIONSHIPS ===//

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
