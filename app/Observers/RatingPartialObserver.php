<?php

namespace App\Observers;

use App\Models\RatingPartial;

class RatingPartialObserver
{
//    public function retrieved(RatingPartial $ratingPartial){}
    public function creating(RatingPartial $ratingPartial)
    {
        if (!isset($ratingPartial->user_id)) {
            $ratingPartial->user_id = auth()->user()->id;
        }
    }
//    public function created(RatingPartial $ratingPartial){}
//    public function updating(RatingPartial $ratingPartial){}
//    public function updated(RatingPartial $ratingPartial){}
//    public function saving(RatingPartial $ratingPartial){}
//    public function saved(RatingPartial $ratingPartial){}
//    public function deleting(RatingPartial $ratingPartial){}
//    public function deleted(RatingPartial $ratingPartial){}
//    public function restoring(RatingPartial $ratingPartial){}
//    public function restored(RatingPartial $ratingPartial){}
//    public function forceDeleted(RatingPartial $ratingPartial){}
}
