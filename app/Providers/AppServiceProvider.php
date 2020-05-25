<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Show;
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
    }
}
