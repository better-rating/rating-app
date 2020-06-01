<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Profile;
use App\Models\RatingPartial;
use App\Models\Show;
use App\Observers\ProfileObserver;
use App\Observers\RatingPartialObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'book'    => Book::class,
            'movie'   => Movie::class,
            'show'    => Show::class,
            'episode' => Episode::class
        ]);

        RatingPartial::observe(RatingPartialObserver::class);
        Profile::observe(ProfileObserver::class);
    }
}
