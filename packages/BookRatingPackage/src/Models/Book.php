<?php

namespace BetterRating\BookRatingPackage\Models;

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

    //=== ATTRIBUTES ===//

    //=== SCOPES ===//

    //=== METHODS ===//
}
