<?php

namespace BetterRating\BookRatingPackage\Traits;

use BetterRating\BookRatingPackage\Models\Book;

trait BookMedia
{
    public function book(Book $book)
    {
        return view('bookratingpackage::media.book', compact('book'));
    }
}
