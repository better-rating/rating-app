<?php

namespace App\Observers;

use App\Models\Profile;

class ProfileObserver
{
//    public function retrieved(Profile $profile){}
    public function creating(Profile $profile)
    {
        if (!isset($profile->user_id)) {
            $profile->user_id = auth()->user()->id;
        }
    }
//    public function created(Profile $profile){}
//    public function updating(Profile $profile){}
//    public function updated(Profile $profile){}
//    public function saving(Profile $profile){}
//    public function saved(Profile $profile){}
//    public function deleting(Profile $profile){}
//    public function deleted(Profile $profile){}
//    public function restoring(Profile $profile){}
//    public function restored(Profile $profile){}
//    public function forceDeleted(Profile $profile){}
}
