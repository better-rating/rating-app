<?php

namespace App\Models;

/**
 * Class Book
 * @package App\Models
 *
 * @table books
 * @col title string
 * @col author string
 * @col publication_date date
 */
class Book extends BaseModel
{
    protected $dates = [
        'publication_date',
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
