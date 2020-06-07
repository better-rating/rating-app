<?php

namespace App\Observers;

use App\Models\Rating;

class RatingObserver
{
//    public function retrieved(Rating $rating){}
    public function creating(Rating $rating)
    {
        if (!isset($rating->user_id)) {
            $rating->user_id = auth()->user()->id;
        }
    }
//    public function created(Rating $rating){}
//    public function updating(Rating $rating){}
//    public function updated(Rating $rating){}
//    public function saving(Rating $rating){}
//    public function saved(Rating $rating){}
//    public function deleting(Rating $rating){}
//    public function deleted(Rating $rating){}
//    public function restoring(Rating $rating){}
//    public function restored(Rating $rating){}
//    public function forceDeleted(Rating $rating){}
}
